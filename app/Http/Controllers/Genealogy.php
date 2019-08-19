<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use App\Genealogy;
use App\GenealogyMatchPoint;
use App\GenealogyMatchLog;
use App\BronzeWallet as Wallet;
use App\BronzeWalletLog as WalletLog;

use App\Http\Resources\Genealogy as GenealogyResource;

class GenealogyController extends Controller
{
    public function test() {
        return 'Hello World';
    }


    public function store(Request $request){
        $data = [];
        // Check if user ID already exist
        if(Genealogy::where('user_id', $request->user_id)->count() != 0){
            // Add error message to data array
            $data[] = ["msg" => "Existing User ID"];
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
                // Call CheckUpStreamMatches
                $this->CheckUpStreamMatches($genealogy);
                // Genea referal reward
                $referalGenea = Genealogy::find($request->referal_id); // Retrieve genea using referal id

                // Retrieve genea wallet
                $referalReward = 500;
                $referalWallet = Wallet::where('genealogy_id', $referalGenea->id)->first(); // Retrieve wallet of referalGenea

                // Retrieve user account status
                $userAccountStatus = $referalGenea->user->userAccountStatus; // Get user account status
                if ($userAccountStatus->status == 'cd') { // Check if account status is cd (cash deduction)
                    $referalWallet->current_balance = (int) $referalWallet->current_balance + 450;
                } else {
                    $referalWallet->current_balance = (int) $referalWallet->current_balance + (int) $referalReward;
                }
                $referalWallet->total_earnings = (int) $referalWallet->total_earnings + (int) $referalReward; // Add referal reward to total earnings
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
        return new GenealogyResource($data); // Return data
    }

    private function RetrieveUpStreamGenea($genea, $upStreamGeneaCollection = []) {
        // Get upstream genea of current genea
        $upStream = (Genealogy::where('user_id', $genea->reference_id)->get())[0];
        // Add retrieve genealogy object to $upStreamGeneaCollection
        $upStreamGeneaCollection[] = $upStream;
        // Exit condition
        if($upStream->id == 1) {
          return ($upStreamGeneaCollection);
        } else {
          return $this->RetrieveUpStreamGenea($upStream, $upStreamGeneaCollection);
        }
    }

    private function GeneList($right_genes=[], $left_genes=[], $gene_array=[], $right_genes_counter=0, $left_genes_counter=0, $flag=true) {
        // Variable to store new left/right genes
        $new_right_genes = [];
        $new_left_genes = [];
        // Condition for root gene. If this is the first time the function is called.
        if($flag) {
            // Iterate over first parameter
            foreach($right_genes as $gene) {
            $user = User::findOrFail($gene->user_id);  // Retrieve customer object of current gene objecet
            $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
            // Add customer data into gene collection/array
            $gene_array[] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo,
            'position' => 'root',
            'referal' => 'none',
            ];
            // Iterate over children
            foreach($children as $child) {
                // Check child position
                if(($child->position) == 'Left') {
                    $new_left_genes[] = $child; // Add left child to left genes collection/array
                    $left_genes_counter++; // Increament left genes counter
                    $user = User::findOrFail($child->user_id); // Retrieve user object of genea
                    $reference = User::findOrFail($child->reference_id); // Refreive user object of reference
                    // Add new item to gene_array 
                    $gene_array[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $user->photo,
                        'position' => 'left',
                        'referal' => [
                            'id' => $reference->id,
                            'name' => $reference->name,
                        ],
                    ];
                } elseif (($child->position) == 'Right') {
                    $new_right_genes[] = $child; // Add right child to right genes collection/array
                    $right_genes_counter++; // Increament right genes counter
                    $user = User::findOrFail($child->user_id); // Retrieve user object of genea
                    $reference = User::findOrFail($child->reference_id); // Refreive user object of reference
                    // Add new item to gene_array 
                    $gene_array[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $user->photo,
                        'position' => 'right',
                        'referal' => [
                            'id' => $reference->id,
                            'name' => $reference->name,
                        ],
                    ];
                }
            }
                return $this->GeneList($new_right_genes, $new_left_genes, $gene_array,$right_genes_counter, $left_genes_counter, false); // Call the function again, passing new parameters
            }
        } else {
            // Iterate over right genes collection/array
            foreach($right_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                $children_count = $children->count(); // Count number of children
                $right_genes_counter += $children_count; // Increament right gene counter
                // Iterate over children
                foreach($children as $child) {
                    $new_right_genes[] = $child;  // Add right child to right genes collection/array
                    $user = User::findOrFail($child->user_id); // Retrieve user object of genea
                    $reference = User::findOrFail($child->reference_id); // Refreive user object of reference
                    // Add new item to gene_array 
                    $gene_array[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $user->photo,
                        'position' => 'right',
                        'referal' => [
                            'id' => $reference->id,
                            'name' => $reference->name,
                        ],
                    ];
                }
            }

            // Iterate over left genes collection/array
            foreach($left_genes as $gene) {
                $children = Genealogy::where('reference_id', $gene->user_id)->get(); // Retrieve children of current gene object
                $children_count = $children->count(); // Count number of children
                $left_genes_counter += $children_count; // Increament left gene counter
                // Iterate over children
                foreach($children as $child) {
                    $new_left_genes[] = $child;  // Add right child to left genes collection/array
                    $user = User::findOrFail($child->user_id); // Retrieve user object of genea
                    $reference = User::findOrFail($child->reference_id); // Refreive user object of reference
                    // Add new item to gene_array 
                    $gene_array[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $user->photo,
                        'position' => 'left',
                        'referal' => [
                            'id' => $reference->id,
                            'name' => $reference->name,
                        ],
                    ];
                }
            }
            // Check number of items inside left/right genes collection/array. If all are 0 then return $gene_array, else call function again
            if((count($right_genes)) == 0 || (count($left_genes)) == 0) {
                return ($gene_array); // Return gene collection/array
            } else {
                return $this->GeneList($new_right_genes, $new_left_genes, $gene_array, $right_genes_counter, $left_genes_counter, false); // Call the function again, passing new parameters
            }
        }
    }

    private function CheckMatch($right_genes, $left_genes=[], $right_genes_counter=0, $left_genes_counter=0, $flag=true) {
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
                    echo "INNER -> ".$child."<br /><br />";
                        $new_left_genes[] = $child; // Add left child to left genes collection/array
                        $left_genes_counter++; // Increament left genes counter
                    } elseif(($child->position) == 'Right') {
                    echo "INNER -> ".$child."<br /><br />";
                        $new_right_genes[] = $child; // Add right child to right genes collection/array
                        $right_genes_counter++; // Increament right genes counter
                    }
                }
                return $this->CheckMatch($new_right_genes, $new_left_genes, $right_genes_counter, $left_genes_counter, false); // Call the function again, passing new parameters
            }
        } else {
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
            // Check number of items inside left/right genes collection/array. If all are 0 then return an array, else call function again
            if((count($right_genes)) == 0 || (count($left_genes)) == 0) {
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
                return $this->CheckMatch($new_right_genes, $new_left_genes, $right_genes_counter, $left_genes_counter, false); // Call the function again, passing new parameters
            }
        }
    }

    private function CheckUpStreamMatches($genea){
        // Retrieve upstream genea
        $upstreams = $this->RetrieveUpStreamGenea($genea);
        // Perform Check match to each up stream
        foreach ($upstreams as $genea) {
            $result = $this->CheckMatch([$genea]); // Run ChecMatch function to current genea
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
                        'user_id' => auth()->user()->id,
                        'genealogy_id' => $genea->id,
                        'remarks' => 'Flushed Out!'
                    ]);
                    // Retrieve Genealogy Match Point object of current genea and increament flushed out matches
                    $geneaMatchPoints = GenealogyMatchPoint::where('genealogy_id', $genea->id)->first();
                    $geneaMatchPoints->matches = (int) $geneaMatchPoints->flushed_out_matches + 1;
                    $geneaMatchPoints->save();
                } else {
                    // Add genealogy log
                    GenealogyMatchLog::create([
                        'user_id' => auth()->user()->id,
                        'genealogy_id' => $genea->id,
                        'remarks' => 'New Match!'
                    ]);

                    // Retrieve Genealogy Match Point object of current genea and increament matches
                    $geneaMatchPoints = GenealogyMatchPoint::where('genealogy_id', $genea->id)->first();
                    $geneaMatchPoints->matches = (int) $geneaMatchPoints->matches + 1;
                    $geneaMatchPoints->save();

                    // Retrieve Wallet object of current genea and add match point reward/incentives
                    $referalReward = 750;
                    $geneaWallet = $genea->bronzeWallet; // $geneaWallet = Wallet::where('genealogy_id', $genea->id)->first();

                    // Retrieve user account status
                    $userAccountStatus = $referalGenea->user->userAccountStatus; // Get user account status
                    if ($userAccountStatus->status == 'cd') { // Check if account status is cd (cash deduction)
                        $geneaWallet->current_balance = (int) $geneaWallet->current_balance + 675;
                    } else {
                        $geneaWallet->current_balance = (int) $geneaWallet->current_balance + (int) $referalReward;
                    }
                    $geneaWallet->total_earnings = (int) $geneaWallet->total_earnings + (int) $referalReward; // Add 750 to total earnings
                    $geneaWallet->save();

                    // Add wallet log
                    WalletLog::create([
                        'wallet_id' => $geneaWallet->id,
                        'amount' => 500,
                        'remarks' => 'Match Point Reward'
                    ]);
                }
            }
        }
    }
}
