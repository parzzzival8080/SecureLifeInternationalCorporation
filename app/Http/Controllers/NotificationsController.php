<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\Roles;
use App\Sponsorships;
use App\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $toReturn = array();
        $notif = Notifications::where('user_id', '=', $request['id'])->orderBy('created_at', 'desc')->get();
        foreach ($notif as $notif)
        {
            $notif->data = (array) json_decode($notif->data);
            array_push($toReturn, $notif);
        }
        return response()->json(['dta'=>$toReturn]);
    }

    public function store($request)
    {
        Notifications::create($request);
    }

    public function KeyDisapproved(Request $request)
    {
        if ($request['notify'] == true)
        {
            $data = ['disapproved_by'=>'Admin'];
            $notif = ['type'=>'KeyDisapproved', 'user_id' => $request['user_id'], 'data'=> json_encode($data)];
            $this->store($notif);
        }
        
        $thisnotif = Notifications::where('type', '=', 'KeyRequest')->get();
        
        if (!is_null($thisnotif))
        {
            if (!$thisnotif->isEmpty())
            {
                foreach ($thisnotif as $thisnotif)
                {
                    $data = json_decode($thisnotif->data);

                    if ($data->proof_id == $request['proof_id'])
                    {
                        $data->status= 'disapproved';
                        Notifications::where('id', '=', $thisnotif->id)->update(['data'=>json_encode($data)]);
                    }
                }
            }
        }
    }

    public function KeyApproved(Request $request)
    {     
        if ($request['notify'] == true)
        {
            $data = ['key'=>$request['key'] ,'approved_by'=>$request['thisid'], 'message'=>'Your request has been approved'];
            $notif = ['type'=>'KeyApproved', 'user_id' => $request['user_id'], 'data'=> json_encode($data)];
            $this->store($notif);
        }
        
        $thisnotif = Notifications::where('type', '=', 'KeyRequest')->get();
        
        if (!is_null($thisnotif))
        {
            if (!$thisnotif->isEmpty())
            {
                foreach ($thisnotif as $thisnotif)
                {
                    $data = json_decode($thisnotif->data);

                    if ($data->proof_id == $request['proof_id'])
                    {
                        $data->status= 'approved';
                        Notifications::where('id', '=', $thisnotif->id)->update(['data'=>json_encode($data)]);
                    }
                }
            }
        }
    }
    
    public function read(Request $request)
    {
        Notifications::where('user_id', '=', $request['id'])->update(['read_at'=>now()]);
    }

    public function userActivated($request)
    {
        //get all admin to notify
        $adminsID = User::select('id')->where('role_id', '=', Roles::where('name', '=', 'admin')->value('id'))->get();
        foreach($adminsID as $thisAdmin)
        {
            $data = ['UserActivatedID'=>$request['id'] ,'UserActivatedName'=>$request['name']]; //fill data array
            $notif = ['type'=>'UserActivated', 'user_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
            $this->store($notif); //call store function
        }

        //notify sponsor
        $sponsor_id = Sponsorships::where('user_id', '=', $request['id'])->value('sponsor_id');
        $sponsor_type = Roles::where('id', '=', User::where('id', '=', $sponsor_id)->value('role_id'))->value('name');
        if (strtoupper($sponsor_type) != 'ADMIN')
        {
            $data = ['UserActivatedID'=>$request['id'] ,'UserActivatedName'=>$request['name']]; //fill data array
            $notif = ['type'=>'UserActivated', 'user_id' => $sponsor_id, 'data'=> json_encode($data)]; //fill notif array
            $this->store($notif); //call store function
        }
    }

    public function KeyRequest($request)
    {
        $adminsID = User::select('id')->where('role_id', '=', Roles::where('name', '=', 'admin')->value('id'))->get();
        foreach($adminsID as $adminsID)
        {
                $data = ['user_id'=>$request['id'] ,'user_name'=>$request['name'], 'user_investment'=> $request['investment'], 'status'=>'pending', 'message'=>$request['name'].' invested amount of '.$request['investment'], 'proof_id'=>$request['proof_id']];
                $notif = ['type'=>'KeyRequest', 'user_id' => $adminsID->id, 'data'=> json_encode($data)];
                $this->store($notif);
        }
    }

    public function getUnreadNotifs(Request $request)
    {
        $toReturn = array();
        $notif = Notifications::where('user_id', '=', $request['id'])->where('read_at', '=', NULL)->orderBy('created_at', 'desc')->get();
        foreach ($notif as $notif)
        {
            $notif->data = (array) json_decode($notif->data);
            array_push($toReturn, $notif);
        }
        return response()->json(['dta'=>$toReturn]);
    }
    
    public function requestEncash(Request $request)
    {
        $adminsID = User::select('id')->where('role_id', '=', Roles::where('name', '=', 'admin')->value('id'))->get();
        foreach($adminsID as $adminsID)
        {
                $data = ['user_id'=>$request['id'] ,'user_name'=>$request['name'], 'encash_amt'=> $request['amount'], 'encash_type'=> $request['type'], 'status'=>'pending', 'message'=>$request['name'].' requested an encashment of '.$request['amount'].' via '.$request['type']];
                $notif = ['type'=>'EncashRequest', 'user_id' => $adminsID->id, 'data'=> json_encode($data)];
                $this->store($notif);
        }
    }

    public function getEncashmentRequests()
    {
        $returnproofs = array();
        $data = array();
        $requests = Notifications::where('type','=','EncashRequest')->get();
        
        foreach ($requests as $requests)
        {
            $data = json_decode($requests->data);
            $returndata = ['id'=>$requests->id, 'user_id'=>$data->user_id, 'user_name'=>$data->user_name, 'amount'=>$data->encash_amt, 'type'=>$data->encash_type, 'status'=>$data->status];
            array_push($returnproofs, $returndata);
        }
        return $returnproofs;
    }

    public function encashmentApproved(Request $request)
    {
        $data = ['approved_by'=>$request['id'], 'message'=>'Your encashment has been approved'];
        $notif = ['type'=>'EncashApproved', 'user_id' => $request['user_id'], 'data'=> json_encode($data)];
        $this->store($notif);

        $thisnotif = Notifications::where('id', '=', $request['notif_id'])->get();
        
        foreach ($thisnotif as $thisnotif)
        {
            $data = json_decode($thisnotif->data);

            $data->status= 'approved';
            Notifications::where('id', '=', $request['notif_id'])->update(['data'=>json_encode($data)]);
        }
    }
}
