<?php

namespace App\Http\Controllers;

use App\Notif;
use App\User;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toReturn = array();
        $notif = Notif::where('notifiable_id', '=', $request['id'])->orderBy('created_at', 'desc')->get();
        foreach ($notif as $notif)
        {
            $notif->data = (array) json_decode($notif->data);
            array_push($toReturn, $notif);
        }
        return response()->json(['dta'=>$toReturn]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        Notif::create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function show(Notif $notif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function edit(Notif $notif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notif $notif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notif $notif)
    {
        //
    }

    public function KeyDisapproved(Request $request)
    {
        if ($request['notify'] == true)
        {
            $data = ['disapproved_by'=>'Admin'];
            $notif = ['type'=>'KeyDisapproved', 'notifiable_id' => $request['user_id'], 'data'=> json_encode($data)];
            $this->store($notif);
        }
        
        $thisnotif = Notif::where('type', '=', 'KeyRequest')->get();
        
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
                        Notif::where('id', '=', $thisnotif->id)->update(['data'=>json_encode($data)]);
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
            $notif = ['type'=>'KeyApproved', 'notifiable_id' => $request['user_id'], 'data'=> json_encode($data)];
            $this->store($notif);
        }
        
        $thisnotif = Notif::where('type', '=', 'KeyRequest')->get();
        
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
                        Notif::where('id', '=', $thisnotif->id)->update(['data'=>json_encode($data)]);
                    }
                }
            }
        }
    }
    
    public function read(Request $request)
    {
        Notif::where('notifiable_id', '=', $request['id'])->update(['read_at'=>now()]);
    }

    public function userActivated($request)
    {
        //get all admin to notify
        $adminsID = User::select('id')->where('type', '=', 'admin')->get();
        foreach($adminsID as $thisAdmin)
        {
            $data = ['UserActivatedID'=>$request['id'] ,'UserActivatedName'=>$request['name']]; //fill data array
            $notif = ['type'=>'UserActivated', 'notifiable_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
            $this->store($notif); //call store function
        }

        //notify sponsor
        $sponsor = User::where('id', '=', $request['id'])->value('sponsor');
        $sponsor_type = User::where('code', '=', $sponsor)->value('type');
        if (strtoupper($sponsor_type) != 'ADMIN')
        {
            $sponsorID = User::where('code', '=', $sponsor)->value('id');
            $data = ['UserActivatedID'=>$request['id'] ,'UserActivatedName'=>$request['name']]; //fill data array
            $notif = ['type'=>'UserActivated', 'notifiable_id' => $sponsorID, 'data'=> json_encode($data)]; //fill notif array
            $this->store($notif); //call store function
        }
    }

    public function KeyRequest($request)
    {
        $adminsID = User::select('id')->where('type', '=', 'admin')->get();
        foreach($adminsID as $adminsID)
        {
                $data = ['user_id'=>$request['id'] ,'user_name'=>$request['name'], 'user_investment'=> $request['investment'], 'status'=>'pending', 'message'=>$request['name'].' invested amount of '.$request['investment'], 'proof_id'=>$request['proof_id']];
                $notif = ['type'=>'KeyRequest', 'notifiable_id' => $adminsID->id, 'data'=> json_encode($data)];
                $this->store($notif);
        }
    }

    public function getUnreadNotifs(Request $request)
    {
        $toReturn = array();
        $notif = Notif::where('notifiable_id', '=', $request['id'])->where('read_at', '=', NULL)->orderBy('created_at', 'desc')->get();
        foreach ($notif as $notif)
        {
            $notif->data = (array) json_decode($notif->data);
            array_push($toReturn, $notif);
        }
        return response()->json(['dta'=>$toReturn]);
    }
    
    public function requestEncash(Request $request)
    {
        $adminsID = User::select('id')->where('type', '=', 'admin')->get();
        foreach($adminsID as $adminsID)
        {
                $data = ['user_id'=>$request['id'] ,'user_name'=>$request['name'], 'encash_amt'=> $request['amount'], 'encash_type'=> $request['type'], 'status'=>'pending', 'message'=>$request['name'].' requested an encashment of '.$request['amount'].' via '.$request['type']];
                $notif = ['type'=>'EncashRequest', 'notifiable_id' => $adminsID->id, 'data'=> json_encode($data)];
                $this->store($notif);
        }
    }

    public function getEncashmentRequests()
    {
        $returnproofs = array();
        $data = array();
        $requests = Notif::where('type','=','EncashRequest')->get();
        
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
        $notif = ['type'=>'EncashApproved', 'notifiable_id' => $request['user_id'], 'data'=> json_encode($data)];
        $this->store($notif);

        $thisnotif = Notif::where('id', '=', $request['notif_id'])->get();
        
            foreach ($thisnotif as $thisnotif)
            {
                $data = json_decode($thisnotif->data);

                $data->status= 'approved';
                Notif::where('id', '=', $request['notif_id'])->update(['data'=>json_encode($data)]);
            }
        }
}
