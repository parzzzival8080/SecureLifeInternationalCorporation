<?php

namespace App\Http\Controllers\Bronze;

use App\User;
use App\Genealogy;
use App\GenealogyMatchPoint;
use App\Product;
use App\UserProductLog;
use App\GroupSalesLog;
use App\GenealogyMatchLog;
use App\BronzeWallet as Wallet;
use App\BronzeWalletLog as WalletLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Bronze as BronzeResource;

class BronzeController extends Controller
{   
    // GET API
    public function points() {
        $user = User::find(1); // auth()->user->id; // Get current user object
        $point = $user->genealogy->genealogyMatchPoint; // Get match point object of current user

        $data = [
            'product_points' => $point->product_points, // Add user product points to $data
            'incentives_points' => $point->incentives_points, // Add user incentives points to $data
            'group_sales_points' => $point->group_sales_points, // Add user group sales points to $data
        ];

        return new BronzeResource($data); // Return data
    }

    // GET API
    public function wallet() {
        $user = User::find(1); // auth()->user->id; // Get current user object
        $genealogy = $user->genealogy; // Get genealogy object of current user
        $wallet = $genealogy->bronzeWallet; // Get wallet object of current user
        $walletLog = $wallet->bronzeWalletLog; // Get all wallet logs of current user
    
        $data = [
            'current_balance' => $wallet->current_balance, // Add user current balance to $data
            'total_earnings' => $wallet->total_earnings, // Add user total earnings to $data
            'wallet_logs' => $walletLog, // Add user wallet logs to $data
        ];

        return new BronzeResource($data); // Return data
    }

    // GET API 
    public function dashboard() {
        $user = User::find(1); // auth()->user->id; // Get current user object
        $genealogy = Genealogy::where('user_id', $user->id)->get()->first();
        $checkMatchResult = $this->check_match([$genealogy]);

        $total_referal = Genealogy::where('referal_id', $genealogy->id)->get()->count();
        $product_points = $genealogy->genealogyMatchPoint->product_points;
        $total_earnings = $genealogy->bronzeWallet->total_earnings;
        $total_balance = $genealogy->bronzeWallet->current_balance;
        $left_downline = $checkMatchResult[0]['left'];
        $right_downline = $checkMatchResult[0]['right'];
        $match_count = $checkMatchResult[0]['matches'];

        $data = [
            'total_earnings' => $total_earnings, // Add user total earnings to $data  
            'product_points' => $product_points, // Add user product points to $data
            'total_earnings' => $total_earnings, // Add user total earnings to $data
            'total_balance' => $total_balance, // Add user total balance to $data
            'left_downline' => $left_downline, // Add user left downline to $data
            'right_downline' => $right_downline, // Add user right downline to $data
            'match_count' => $match_count, // Add user match count to $data
        ];

        return new BronzeResource($data); // Return data
    }
    
    // GET API, optional params=[user_id]
    public function genealogy(Request $request) {
        // Check if request contains a user_id
        if($request->user_id) {
            $user = User::find($request->user_id); // Get user object using supplied user_id
        } else {
            $user = User::find(1); // auth()->user->id; // Get current user object
        }
        $genea = $user->genealogy; // Get genealogy object of user
        $genealogy_tree = $this->genealogy_tree($genea); // Call GeneList function

        $data = [
            'genealogy_tree' => $genealogy_tree, // Add user genealogy tree
        ];

        return new BronzeResource($data); // Return data
    }

    // POST API, params = [user_id, reference_id, referal_id, position]
    public function create_genealogy(Request $request){
        $data = [];
        // Check if user ID already exist
        if(Genealogy::where('user_id', $request->user_id)->count() != 0){
            // Add error message to data array
            $data[] = ["msg" => "Existing User ID"];
        } elseif ((Genealogy::where('reference_id', $request->reference_id)->where('position', $request->position)->get()->count()) > 0) {
            // Add error message to data array
           $data[] = ["msg" => "Reference ID position is already taken"];
        } else {
            // Create new genealogy object
            $genealogy = Genealogy::create([
                'user_id' => $request->user_id,
                'reference_id' => $request->reference_id,
                'referal_id' => $request->referal_id,
                'position' => $request->position,
            ]);
            // Create new genealogy match point object
            $genealogyMatchPoint = GenealogyMatchPoint::create([
                'genealogy_id' => $genealogy->id,
            ]);
            
            // Get user object then create new wallet
            $user = User::find($request->user_id);
            if($user->userAccountStatus->status == 'cd') {
                $wallet = Wallet::create([
                    'genealogy_id' => $genealogy->id,
                    'current_balance' => -3995,
                ]);
            } else {
                $wallet = Wallet::create([
                    'genealogy_id' => $genealogy->id,
                ]);
            }

            // Check if genea position is Root
            if($request->position != 'Root') {
                // Call check_upstream_matches
                $this->check_upstream_matches($genealogy);
                // Genea referal reward
                $referalGenea = Genealogy::find($request->referal_id); // Retrieve genea using referal id

                // Retrieve genea wallet
                // $referalReward = 500;
                $referalWallet = Wallet::where('genealogy_id', $referalGenea->id)->first(); // Retrieve wallet of referalGenea

                // Retrieve user account status
                $userAccountStatus = $referalGenea->user->userAccountStatus; // Get user account status
                $referalWallet->current_balance = (int) $referalWallet->current_balance + 450;
                $referalWallet->total_earnings = (int) $referalWallet->total_earnings + 500; // Add referal reward to total earnings
                $referalWallet->save();
                
                // Add wallet log
                WalletLog::create([
                    'wallet_id' => $referalWallet->id,
                    'amount' => 500,
                    'remarks' => 'Referal Reward'
                ]);
            }
            // Add msg, genealogy, and match points to data
            $data[] = [
                "msg" => "New Genealogy Added",
                'genealogy' => $genealogy,
                'genealogy_match_point' => $genealogyMatchPoint,
            ];
        }
        return new BronzeResource($data); // Return data
    }

     // PRODUCT PURCHASE API
    public function product_purchase(Request $request){
        $user = User::find($request->user_id); // Retrieve user object, using user_id
        $product = Product::find($request->product_id); // Retrieve product object, using product_id
        $quantity = $request->quantity; // Get quantity

        $userMatchPoint = $user->genealogy->genealogyMatchPoint; // Retrieve user match point object of user
        $productPoints = $userMatchPoint->product_points + ((int) $product->points * $quantity); // Calculate total product points
        $userMatchPoint->product_points = $productPoints; // Set user product points
        $userMatchPoint->save(); // Save changes

        $this->check_upstream_group_sales($user->genealogy); // Run check_upstream_group_sales for uplines

        // Create new user product log
        $userProductLog = UserProductLog::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'points' => ((int) $product->points * $quantity),
            'remarks' => 'Successful Purchase'
        ]);

        $data = [
            'data' => $productPoints,
        ];
        
        return new BronzeResource($userProductLog); // Return user product log as a response
    }

    private function retrieve_upstream_genea($genea, $upstream_genea_collection = []) {
        // Get upstream genea of current genea
        $upStream = (Genealogy::where('user_id', $genea->reference_id)->get())[0];
        // Add retrieve genealogy object to $upstream_genea_collection
        $upstream_genea_collection[] = $upStream;
        // Exit condition
        if($upStream->id == 1) {
            return ($upstream_genea_collection);
        } else {
            return $this->retrieve_upstream_genea($upStream, $upstream_genea_collection);
        }
    }

    private function check_group_sales($right_genes, $left_genes=[], $right_group_sales=0, $left_group_sales=0, $flag=true) {
        // Variable to store new left/right genes
        $new_right_genes = [];
        $new_left_genes = [];

        // Condition for root gene. If this is the first time the function is called.
        if($flag) {
            // Iterate over first parameter
            foreach($right_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                // Iterate over children
                foreach($children as $child) {
                    // Check child position
                    if(($child->position) == 'Left') {
                        $new_left_genes[] = $child; // Add left child to left genes collection/array
                        $left_group_sales+=$child->genealogyMatchPoint->product_points; // Increament left group sales counter
                    } elseif(($child->position) == 'Right') {
                        $new_right_genes[] = $child; // Add right child to right genes collection/array
                        $right_group_sales+=$child->genealogyMatchPoint->product_points; // Increament right group sales counter
                    }
                }
                return $this->check_group_sales($new_right_genes, $new_left_genes, $right_group_sales, $left_group_sales, false); // Call the function again, passing new parameters
            }
        } else {
            // Iterate over right genes collection/array
            foreach($right_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                $children_count = $children->count(); // Count number of children
                // Iterate over children
                foreach($children as $child) {
                    $new_right_genes[] = $child; // Add child to new right genes collection/array
                    $right_group_sales+=$child->genealogyMatchPoint->product_points; // Increament right group sales counter
                }
            }
            // Iterate over left genes collection/array
            foreach($left_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                $children_count = $children->count(); // Count number of children
                // Iterate over children
                foreach($children as $child) {
                    $new_left_genes[] = $child; // Add child to new left genes collection/array
                    $left_group_sales+=$child->genealogyMatchPoint->product_points; // Increament left group sales counter
                }
            }
            // Check number of items inside left/right genes collection/array. If all are 0 then return an array, else call function again
            if((count($right_genes)) == 0 || (count($left_genes)) == 0) {
                if($right_group_sales >= 500 and $left_group_sales >= 500) {
                    $right_group_sales_point = floor($right_group_sales/500);
                    $left_group_sales_point = floor($left_group_sales/500);

                    $group_sales = $right_group_sales_point <= $left_group_sales_point ? $right_group_sales_point : $left_group_sales_point;

                    return array([
                        'group_sales' => $group_sales,
                        'left' => $left_group_sales,
                        'right' => $right_group_sales,
                    ]);
                } else {
                    return array([
                        'group_sales' => 0,
                        'left' => $left_group_sales,
                        'right' => $right_group_sales,
                        ]);
                }
            } else {
                return $this->check_group_sales($new_right_genes, $new_left_genes, $right_group_sales, $left_group_sales, false); // Call the function again, passing new parameters
            }
        }
    }

    private function check_upstream_group_sales($genea) {
        $upstreams = $this->retrieve_upstream_genea($genea); // Retrieve upstream genea
        // Perform Check match to each up stream
        foreach ($upstreams as $genea) {
            $result = $this->check_group_sales([$genea]);  // Run check_group_sales function to current genea
            $recent_group_sales = $result[0]['group_sales'];  // Get recent group sales
            $old_group_sales = GenealogyMatchPoint::select('group_sales_points')->where('genealogy_id', $genea->id)->first()->group_sales_points;  // Get old group sales
            // Compare recent and old group sales
            if((int) $old_group_sales < (int) $recent_group_sales) {
                $salesMatches = (int) $recent_group_sales - (int) $old_group_sales; // Get total recent sales
                $geneaMatchPoint = $genea->genealogyMatchPoint; // Retrive genealogy match point object of current genea
                $geneaMatchPoint->group_sales_points = (int) $geneaMatchPoint->group_sales_points + (int) $salesMatches; // Add total recent group sales to old group sales
                $geneaMatchPoint->save(); // Save updates

                // Create group sales log
                GroupSalesLog::create([
                    'genealogy_id' => $genea->id,
                    'matches' => $salesMatches,
                    'remarks' => "Group Sales Match!"
                ]);
            }
        }
    }

    private function check_match($right_genes, $left_genes=[], $right_genes_counter=0, $left_genes_counter=0, $flag=true) {
        // Variable to store new left/right genes
        $new_right_genes = [];
        $new_left_genes = [];
        // Condition for root gene. If this is the first time the function is called.
        if($flag) {
            // Iterate over first parameter
            foreach($right_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                // Iterate over children
                foreach($children as $child) {
                    // Check child position
                    if(($child->position) == 'Left') {
                        $new_left_genes[] = $child; // Add left child to left genes collection/array
                        $left_genes_counter++; // Increament left genes counter
                    } elseif(($child->position) == 'Right') {
                        $new_right_genes[] = $child; // Add right child to right genes collection/array
                        $right_genes_counter++; // Increament right genes counter
                    }
                }
                return $this->check_match($new_right_genes, $new_left_genes, $right_genes_counter, $left_genes_counter, false); // Call the function again, passing new parameters
            }
        } else {
            // Iterate over left genes collection/array
            foreach($left_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                $children_count = $children->count(); // Count number of children
                $left_genes_counter += $children_count; // Increament left gene counter
                // Iterate over children
                foreach($children as $child) {
                    $new_left_genes[] = $child; // Add child to new left genes collection/array
                }
            }
            
            // Iterate over right genes collection/array
            foreach($right_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                $children_count = $children->count(); // Count number of children
                $right_genes_counter += $children_count; // Increament right gene counter
                // Iterate over children
                foreach($children as $child) {
                    $new_right_genes[] = $child; // Add child to new right genes collection/array
                }
            }
            
            // Check number of items inside left/right genes collection/array. If all are 0 then return an array, else call function again
            if((count($right_genes)) == 0 && (count($left_genes)) == 0) {
                if($right_genes_counter <= $left_genes_counter) {
                    return array([
                        'matches' => $right_genes_counter,
                        'left' => $left_genes_counter,
                        'right' => $right_genes_counter,
                    ]);
                } else {
                    return array([
                        'matches' => $left_genes_counter,
                        'left' => $left_genes_counter,
                        'right' => $right_genes_counter,
                    ]);
                }
            } else {
                return $this->check_match($new_right_genes, $new_left_genes, $right_genes_counter, $left_genes_counter, false); // Call the function again, passing new parameters
            }
        }
    }

    private function check_upstream_matches($genea){
        // Retrieve upstream genea
        $upstreams = $this->retrieve_upstream_genea($genea);
        // Perform Check match to each up stream
        foreach ($upstreams as $genea) {
            $result = $this->check_match([$genea]); // Run ChecMatch function to current genea
            $recent_match_count = $result[0]['matches']; // Get recent match count
            $old_match_count = GenealogyMatchPoint::select('matches', 'flushed_out_matches')->where('genealogy_id', $genea->id)->first(); // Get old match count and flushed out matches
            $old_match_count = (int) $old_match_count->matches + (int) $old_match_count->flushed_out_matches; // Add match count and flushed out matches
            
            // Compare recent match count and old match count
            if((int) $old_match_count < (int) $recent_match_count) {
                $cycle_match_count = 0;
                if(date('A', time()) == 'AM') {
                    $cycle_match_count = GenealogyMatchLog::where('genealogy_id', $genea->id)
                    ->whereBetween('created_at', [date('Y-m-d', time())." 00:00:00", date('Y-m-d', time())." 12:00:00"])
                    ->count(); // Count all AM match entries for current genea
                } else {
                    $cycle_match_count = GenealogyMatchLog::where('genealogy_id', $genea->id)
                    ->whereBetween('created_at', [date('Y-m-d', time())." 12:01:00", date('Y-m-d', time())." 23:59:00"])
                    ->count();// Count all PM match entries for current genea
                }
                // Check if match count is >= 7 for current cycle
                if((int) $cycle_match_count >= 7) {
                    // Add genealogy log
                    GenealogyMatchLog::create([
                        'user_id' => 1,
                        'genealogy_id' => $genea->id,
                        'remarks' => 'Flushed Out!'
                    ]);
                    // Retrieve Genealogy Match Point object of current genea and increament flushed out matches
                    $geneaMatchPoints = GenealogyMatchPoint::where('genealogy_id', $genea->id)->first();
                    $geneaMatchPoints->flushed_out_matches = (int) $geneaMatchPoints->flushed_out_matches + 1;
                    $geneaMatchPoints->save();
                } else {
                    // Add genealogy log
                    GenealogyMatchLog::create([
                        'user_id' => 1,
                        'genealogy_id' => $genea->id,
                        'remarks' => 'New Match!'
                    ]);

                    // Retrieve Genealogy Match Point object of current genea and increament matches
                    $geneaMatchPoints = GenealogyMatchPoint::where('genealogy_id', $genea->id)->first();
                    $geneaMatchPoints->matches = (int) $geneaMatchPoints->matches + 1;
                    $geneaMatchPoints->save();

                    // Retrieve Wallet object of current genea and add match point reward/incentives
                    // $referalReward = 750;
                    $geneaWallet = $genea->bronzeWallet; // $geneaWallet = Wallet::where('genealogy_id', $genea->id)->first();

                    // Retrieve user account status
                    $userAccountStatus = $genea->user->userAccountStatus; // Get user account status
                    $geneaWallet->current_balance = (int) $geneaWallet->current_balance + 675;
                    $geneaWallet->total_earnings = (int) $geneaWallet->total_earnings + 750; // Add 750 to total earnings
                    $geneaWallet->save();

                    // Add wallet log
                    WalletLog::create([
                        'wallet_id' => $geneaWallet->id,
                        'amount' => 750,
                        'remarks' => 'Match Point Reward'
                    ]);
                }
            }
        }
    }

    public function genealogy_tree($genea) {
        // 1st Row
        $first_row = [];
        $first_row[1] = ['id' => $genea->user->id, 'code' => $genea->user->code, 'name' => $genea->user->name, 'email' => $genea->user->email, 'photo' => $genea->user->photo, 'position' => 'root', 'referal' => 'none',];

        // 2nd Row
        $second_row = [];

        $left_child = Genealogy::where('reference_id', $genea->user_id)->where('position', 'Left')->get()->first();
        $second_row[2] = $left_child ? [
            'id' => $left_child->user->id, 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
            'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference->id, 'name' => $left_child->reference->name, ],
        ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];;

        $right_child = Genealogy::where('reference_id', $genea->user_id)->where('position', 'Right')->get()->first();
        $second_row[3] = $right_child ? [
            'id' => $right_child->user->id, 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
            'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference->id, 'name' => $right_child->reference->name, ],
        ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];;

        // 3rd Row
        $third_row = [];
        if($second_row[2]['id'] == 'None') {
            $third_row[4] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $third_row[5] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        } else {
            $left_child = Genealogy::where('reference_id', $second_row[2]['id'])->where('position', 'Left')->get()->first();
            $third_row[4] = $left_child ? [
                'id' => $left_child->user['id'], 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
                'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference['id'], 'name' => $left_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];

            $right_child = Genealogy::where('reference_id', $second_row[2]['id'])->where('position', 'Right')->get()->first();
            $third_row[5] = $right_child ? [
                'id' => $right_child->user['id'], 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
                'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference['id'], 'name' => $right_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        }

        if($second_row[3]['id'] == 'None') {
            $third_row[6] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $third_row[7] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        } else {
            $left_child = Genealogy::where('reference_id', $second_row[3]['id'])->where('position', 'Left')->get()->first();
            $third_row[6] = $left_child ? [
                'id' => $left_child->user['id'], 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
                'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference['id'], 'name' => $left_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];

            $right_child = Genealogy::where('reference_id', $second_row[3]['id'])->where('position', 'Right')->get()->first();
            $third_row[7] = $right_child ? [
                'id' => $right_child->user['id'], 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
                'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference['id'], 'name' => $right_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        }
        
        // 4th Row
        $fourth_row = [];
        if($third_row[4]['id'] == 'None') {
            $fourth_row[8] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $fourth_row[9] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        } else {
            $left_child = Genealogy::where('reference_id', $third_row[4]['id'])->where('position', 'Left')->get()->first();
            $fourth_row[8] = $left_child ? [
                'id' => $left_child->user['id'], 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
                'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference['id'], 'name' => $left_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];

            $right_child = Genealogy::where('reference_id', $third_row[4]['id'])->where('position', 'Right')->get()->first();
            $fourth_row[9] = $right_child ? [
                'id' => $right_child->user['id'], 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
                'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference['id'], 'name' => $right_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        }

        if($third_row[5]['id'] == 'None') {
            $fourth_row[10] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $fourth_row[11] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        } else {
            $left_child = Genealogy::where('reference_id', $third_row[5]['id'])->where('position', 'Left')->get()->first();
            $fourth_row[10] = $left_child ? [
                'id' => $left_child->user['id'], 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
                'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference['id'], 'name' => $left_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $right_child = Genealogy::where('reference_id', $third_row[5]['id'])->where('position', 'Right')->get()->first();
            $fourth_row[11] = $right_child ? [
                'id' => $right_child->user['id'], 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
                'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference['id'], 'name' => $right_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        }

        if($third_row[6]['id'] == 'None') {
            $fourth_row[12] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $fourth_row[13] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        } else {
            $left_child = Genealogy::where('reference_id', $third_row[6]['id'])->where('position', 'Left')->get()->first();
            $fourth_row[12] = $left_child ? [
                'id' => $left_child->user['id'], 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
                'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference['id'], 'name' => $left_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $right_child = Genealogy::where('reference_id', $third_row[6]['id'])->where('position', 'Right')->get()->first();
            $fourth_row[13] = $right_child ? [
                'id' => $right_child->user['id'], 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
                'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference['id'], 'name' => $right_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        }

        if($third_row[7]['id'] == 'None') {
            $fourth_row[14] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $fourth_row[15] = ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        } else {
            $left_child = Genealogy::where('reference_id', $third_row[7]['id'])->where('position', 'Left')->get()->first();
            $fourth_row[14] = $left_child ? [
                'id' => $left_child->user['id'], 'code' => $left_child->user->code, 'name' => $left_child->user->name, 'email' => $left_child->user->email, 
                'photo' => $left_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $left_child->reference['id'], 'name' => $left_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
            $right_child = Genealogy::where('reference_id', $third_row[7]['id'])->where('position', 'Right')->get()->first();
            $fourth_row[15] = $right_child ? [
                'id' => $right_child->user['id'], 'code' => $right_child->user->code, 'name' => $right_child->user->name, 'email' => $right_child->user->email, 
                'photo' => $right_child->user->photo, 'position' => 'right', 'referal' => [ 'id' => $right_child->reference['id'], 'name' => $right_child->reference->name, ],
            ] : ['id' => 'None', 'code' => 'None', 'name' => 'None', 'email' => 'None', 'photo' => 'None', 'position' => 'None', 'referal' => 'None',];
        }

        $genealogy_tree = $first_row + $second_row + $third_row + $fourth_row;
        return $genealogy_tree;
    }
}
