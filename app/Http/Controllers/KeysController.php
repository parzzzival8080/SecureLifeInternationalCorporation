<?php

namespace App\Http\Controllers;

use App\CurrentQueue;
use App\DiamondQueues;
use App\Keys;
use App\User;
use App\Wallets;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    public function checkKey(Request $request)
    {
        $keys= Keys::where('key', '=', $request['key'])
        ->where('status', '=', 'Inactive')
        ->where('user_id', '=', $request['userid'])
        ->get();
        $msg = false;
        if ($keys->isEmpty()){
            $keys= Keys::where('key', '=', $request['key'])
            ->where('status', '=', 'Inactive')
            ->where('user_id', '=', '1')
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
                $this->activateKey($request);
                $msg = true;
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
            $this->activateKey($request);
            $msg = true;
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
                            
                            $adminIDs = User::where('type', '=', 'admin')->get();
                    
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
                            Wallets::create([
                                'user_id' => $allqueues->user_id,
                                'amount' => ($allqueues->exit/5) * 30000,
                                'remarks' => 'Exit',
                                'encashed' => '0',
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
        $key=Keys::create([
            'user_id' => $request['user_id'],
            'key' => $request['key'],
            'status' => $request['status'],
            'investment' => $request['investment'],
        ]);
        
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
        return Keys::select('id', 'key', 'investment', 'status')->where('key', '<>', 'lala')->get();
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
