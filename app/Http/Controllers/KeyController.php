<?php

namespace App\Http\Controllers;

use App\Key;
use App\Queue;
use App\User;
use App\Bracket;
use App\Wallet;
use App\Notif;

use Illuminate\Http\Request;

use App\Http\Controllers\NotifController;

class KeyController extends Controller
{
    public function index()
    {
        //
    }

    public function checkKey(Request $request)
    {
        $keys= Key::where('key', '=', $request['key'])
        ->where('status', '=', 'Inactive')
        ->where('user_id', '=', $request['userid'])
        ->get();
        $msg = false;
        if ($keys->isEmpty()){
            $keys= Key::where('key', '=', $request['key'])
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
        Key::where('key', '=', $request['key'])
            ->where('status', '=', 'Inactive')
            ->update(['user_id'=>$request['userid']]);
        
        return response()->json(['data'=>$msg]);
    }

    public function activateKey(Request $request)
    {
        $msg=false;
        Queue::create(['user_id' => $request['userid'], 'exit' => $request['exit']]);
        User::findOrFail($request['userid'])->update(['status' => 'Active']);
        $brackets = Bracket::all();
        if ($brackets->isEmpty()){
            Bracket::create([
                'currentBracket' => '1',
                'bracketCount' => '0',
                'exit' => $request['exit']
            ]);
        }
        else{
            foreach ($brackets as $bracket) {
                $chck= $bracket->bracketCount + ($request['exit']/5);
                if ($chck >= $bracket->exit){
                    $newexit = 0;
                    $allqueues = Queue::where('id', '>=', $bracket->currentBracket)->get();
                    foreach($allqueues as $allqueues){
                        if ($chck>=$allqueues->exit){
                            
                            $adminIDs = User::where('type', '=', 'admin')->get();
                    
                            $ctrler = new NotifController;
                            $data = ['admin_message'=>$allqueues->name.' has been exited', 'user_message'=>'Congratulation! Your account has been exited'];
                            
                            $notif = ['type'=>'UserExit', 'notifiable_id' => $allqueues->user_id, 'data'=> json_encode($data)];
                            $ctrler->store($notif);
                            foreach ($adminIDs as $adminIDs)
                            {
                                $notif = ['type'=>'UserExit', 'notifiable_id' => $adminIDs->id, 'data'=> json_encode($data)];
                                $ctrler->store($notif);
                            }

                            Queue::where('id', '=', $allqueues->id)->update(['exited' => '1']);
                            Queue::create(['user_id' => $allqueues->user_id, 'exit' => $allqueues->exit]);
                            $newexit = $newexit + ($allqueues->exit/5);
                            Wallet::create([
                                'user_id' => $allqueues->user_id,
                                'amount' => ($allqueues->exit/5) * 30000,
                                'remarks' => 'Exit',
                                'encashed' => '0',
                            ]);
                        }
                        else{
                            $thisexit= $allqueues->exit;
                            $bracket->currentBracket = $allqueues->id;
                            break;
                        }
                    }
                    $bracket->update(['currentBracket' => $bracket->currentBracket,'bracketCount' => $newexit, 'exit' => $thisexit]);
                }
                else{
                    $bracket->update(['bracketCount' => $bracket->bracketCount + ($request['exit']/5)]);
                }
            }
        }
        $msg=true;
        return response()->json(['data'=>$msg]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $key=Key::create([
            'user_id' => $request['user_id'],
            'key' => $request['key'],
            'status' => $request['status'],
            'investment' => $request['investment'],
        ]);
        
        return $key->id;
    }

    public function show(Key $key)
    {
        //
    }

    public function edit(Key $key)
    {
        //
    }

    public function destroy($id)
    {
        
        $key = Key::findOrFail($id);

        $key->delete();

        return ['message' => 'key Deleted'];
    }

    //get all keys for Keys.vue
    public function getAllKeys()
    {
        return Key::select('id', 'key', 'investment', 'status')->where('key', '<>', 'lala')->get();
    }

    //get available keys for Activate.vue
    public function getMyKeys(Request $request)
    {
        return Key::where('user_id', '=', $request['id'])->get();
    }
    
    public function myAccounts(Request $request)
    {
        return response()->json(['count'=>Key::where('user_id', '=', $request['id'])->where('status', '=', 'Active')->sum('investment')/20000]);
    }
}