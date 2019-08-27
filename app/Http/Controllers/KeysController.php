<?php

namespace App\Http\Controllers;

use App\CurrentQueue;
use App\DiamondQueues;
use App\Genealogy;
use App\Http\Controllers\Bronze\BronzeController;
use App\Keys;
use App\Roles;
use App\User;
use App\UserAccountStatus;
use App\WalletLogs;
use App\Wallets;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    public function checkKey(Request $request)
    {
        $keys= Keys::where('key', '=', $request['key'])
        ->where('pin', '=', $request['pin'])
        ->where('status', '=', 'Inactive')
        ->where('user_id', '=', $request['userid'])
        ->get();
        $msg = false;
        if ($keys->isEmpty()){
            $keys= Keys::where('key', '=', $request['key'])
            ->where('pin', '=', $request['pin'])
            ->where('status', '=', 'Inactive')
            ->where('user_id', '=', User::where('role_id', '=', '1')->value('id'))
            ->get();
            $msg = false;
            if ($keys->isEmpty()){
                $msg = false;
            }
            else{
                $exit = 0;
                foreach ($keys as $key){
                    $investment = $key->investment;
                    if ($request['accounts'] + ($investment / 20000)>50)
                    {
                        return response()->json(['data'=>false]);
                    }
                    $exit = ($investment / 20000) * 5;
                }
                $key->update(['status' => 'Active']);
                $request['exit']=$exit;
                if (!$request['reference_id'])
                {
                    $this->activateKey($request);
                    $msg = true;
                }
                else{
                    //check genea
                    $genea = Genealogy::where('user_id', '=', $request['referal_id'])->get();

                    if ($genea->isEmpty())
                    {
                        return response()->json(['error' => 'Incorrect Placement ID']);
                    }
                    
                    $genea = Genealogy::where('reference_id', '=', $request['reference_id'])->where('position', '=', $request['position'])->get();

                    if (!$genea->isEmpty())
                    {
                        return response()->json(['error' => 'Incorrect Placement ID']);
                    }

                    $status = '';
                    if (substr($request['key'], 0, 4) == 'SLCD')
                    {
                        $status = 'cd';
                    }
                    else
                    {
                        $status = 'active';
                    }

                    UserAccountStatus::create([
                        'user_id'=>$request['userid'],
                        'status'=>$status,
                    ]);
                    User::where('id', '=', $request['userid'])->update(['status'=>'Active']);

                    $geneaController = new BronzeController;
                    $geneaController->create_genealogy($request);
                    $msg = true;
                }
            }
        }
        else{
            $exit = 0;
            foreach ($keys as $key){
                $investment = $key->investment;
                if ($request['accounts'] + ($investment / 20000)>50)
                {
                    return response()->json(['data'=>false]);
                }
                $exit = ($investment / 20000) * 5;
            }
            $key->update(['status' => 'Active']);
            $request['exit']=$exit;
            if (!$request['reference_id'])
                {
                    $this->activateKey($request);
                    $msg = true;
                }
                else{
                    //check genea
                    $genea = Genealogy::where('user_id', '=', $request['reference_id'])->get();

                    if ($genea->isEmpty())
                    {
                        return response()->json(['error' => 'Incorrect Placement ID']);
                    }
                    
                    $genea = Genealogy::where('reference_id', '=', $request['reference_id'])->where('position', '=', $request['position'])->get();

                    if (!$genea->isEmpty())
                    {
                        return response()->json(['error' => 'Incorrect Placement ID']);
                    }

                    UserAccountStatus::create([
                        'user_id'=>$request['userid'],
                        'status'=>'active',
                    ]);
                    User::where('id', '=', $request['userid'])->update(['status'=>'Active']);

                    $geneaController = new BronzeController;
                    $geneaController->create_genealogy($request);
                    $msg = true;
                }
        }
        Keys::where('key', '=', $request['key'])
            ->where('status', '=', 'Inactive')
            ->update(['user_id'=>$request['userid']]);
        
        return response()->json(['data'=>$msg]);
    }

    public function activateKey(Request $request)
    {
        $msg=false;
        DiamondQueues::create(['user_id' => $request['userid'], 'exit' => $request['exit']]);
        User::findOrFail($request['userid'])->update(['status' => 'Active']);
        $brackets = CurrentQueue::all();
        if ($brackets->isEmpty()){
            CurrentQueue::create([
                'queue_id' => '1',
                'queue_count' => '0',
                'exit' => $request['exit']
            ]);
        }
        else{
            foreach ($brackets as $bracket) {
                $chck= $bracket->queue_count + ($request['exit']/5);
                if ($chck >= $bracket->exit){
                    $newexit = 0;
                    $allqueues = DiamondQueues::where('id', '>=', $bracket->queue_id)->get();
                    foreach($allqueues as $allqueues){
                        if ($chck>=$allqueues->exit){
                            
                            $adminIDs = User::select('id')->where('role_id', '=', Roles::where('name', '=', 'admin')->value('id'))->get();
                    
                            $ctrler = new NotificationsController;
                            $data = ['admin_message'=>$allqueues->name.' has been exited', 'user_message'=>'Congratulation! Your account has been exited'];
                            
                            $notif = ['type'=>'UserExit', 'user_id' => $allqueues->user_id, 'data'=> json_encode($data)];
                            $ctrler->store($notif);
                            foreach ($adminIDs as $adminIDs)
                            {
                                $notif = ['type'=>'UserExit', 'user_id' => $adminIDs->id, 'data'=> json_encode($data)];
                                $ctrler->store($notif);
                            }

                            DiamondQueues::where('id', '=', $allqueues->id)->update(['exited' => '1']);
                            DiamondQueues::create(['user_id' => $allqueues->user_id, 'exit' => $allqueues->exit]);
                            $newexit = $newexit + ($allqueues->exit/5);
                            $chck = $chck - $allqueues->exit;

                            $wallet_id = Wallets::where('user_id', '=', $allqueues->user_id)->value('id');
                            $total_earnings = Wallets::where('user_id', '=', $allqueues->user_id)->value('total_earnings');
                            if ($wallet_id == 0)
                            {
                                $wallet_id=Wallets::create([
                                    'user_id' => $allqueues->user_id,
                                    'total_earnings'=>($allqueues->exit/5) * 30000,
                                    'current_balance'=>($allqueues->exit/5) * 30000 - (($allqueues->exit/5) * 30000 *.10),
                                ])->value('id');
                            }
                            else
                            {
                                $total_earnings += ($allqueues->exit/5) * 30000;
                                Wallets::where('id', '=', $wallet_id)->update([
                                    'total_earnings' => $total_earnings,
                                    'current_balance'=> $total_earnings - ($total_earnings *.10),
                                ]);
                            }
                            WalletLogs::create([
                                'wallet_id' => $wallet_id,
                                'amount' => ($allqueues->exit/5) * 30000,
                                'remarks' => 'Exit Reward',
                            ]);
                        }
                        else{
                            $thisexit= $allqueues->exit;
                            $bracket->queue_id = $allqueues->id;
                            break;
                        }
                    }
                    $bracket->update(['queue_id' => $bracket->queue_id,'queue_count' => $newexit, 'exit' => $thisexit]);
                }
                else{
                    $bracket->update(['queue_count' => $bracket->queue_count + ($request['exit']/5)]);
                }
            }
        }
        $msg=true;
        return response()->json(['data'=>$msg]);
    }

    public function store(Request $request)
    {
        $key=Keys::create($request->all());
        
        return $key->id;
    }

    public function destroy($id)
    {
        
        $key = Keys::findOrFail($id);

        $key->delete();

        return ['message' => 'key Deleted'];
    }

    //get all keys for Keys.vue
    public function getAllKeys()
    {
        return Keys::select('id', 'key', 'pin', 'investment', 'status')->where('key', '<>', 'lala')->get();
    }

    //get available keys for Activate.vue
    public function getMyKeys(Request $request)
    {
        return Keys::where('user_id', '=', $request['id'])->get();
    }
    
    public function myAccounts(Request $request)
    {
        return response()->json(['count'=>Keys::where('user_id', '=', $request['id'])->where('status', '=', 'Active')->sum('investment')/20000]);
    }
}
