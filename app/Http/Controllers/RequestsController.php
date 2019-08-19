<?php

namespace App\Http\Controllers;

use App\Requests;
use Illuminate\Http\Request;
use Cloudder;

class RequestsController extends Controller
{
    public function store(Request $request)
    {
        Cloudder::upload($request['image'], null, ['folder'=>'SecureLife/proofs_test/']);
        $request['image'] = Cloudder::show(Cloudder::getPublicId());

        $proof = Requests::create($request->all());

        $request['proof_id']=$proof->id;
        
        $notifcontroller = new NotifController;
        $notifcontroller->KeyRequest($request);
        $msg = true;
        return response()->json(['data'=>$msg]);
    }
  
    public function getRequests(Request $request)
    {
        $returnproofs = array();
        $proofs = Requests::all();
        foreach ($proofs as $proofs)
        {
            $proofs->user_id = User::where('id', '=', $proofs->user_id)->value('name');
            array_push($returnproofs, $proofs);
        }
        return $returnproofs;
    }

    public function approveRequest(Request $request)
    {
        Requests::where('id', '=', $request['proof_id'])->update(['status'=>'approved', 'investment'=>$request['investment']]);
        
        $request['user_id'] = User::where('email', '=', $request['user_id'])->value('id');
        
        $keycontroller = new KeyController;
        $keyID = $keycontroller->store($request);
        
        $notify = DiamondQueues::where('user_id', '=', $request['user_id'])->get();
        
        if($notify->count() >= 1)
        {
            $request['notify']=true;
        }
        else
        {
            $request['notify']=false;
        }
        
        $notifcontroller = new NotifController;
        $notifcontroller->KeyApproved($request);
        
        return response()->json(['id'=>$keyID, 'investment'=>$request['investment'], 'status'=>'Inactive']);
    }
    
    public function disapproveRequest(Request $request)
    {
        Requests::where('id', '=', $request['proof_id'])->update(['status'=>'disapproved']);
        
        $request['user_id'] = User::where('email', '=', $request['user_id'])->value('id');

        $notify = DiamondQueues::where('user_id', '=', $request['user_id'])->get();
        // return $notify->count();
        if($notify->count() >= 1)
        {
            $request['notify']=true;
        }
        else
        {
            $request['notify']=false;
        }
        
        $notifcontroller = new NotifController;
        $notifcontroller->KeyDisapproved($request);
    }

    public function getMyRequests(Request $request)
    {
        return Requests::where('user_id', '=', $request['id'])->where('status', '<>', 'approved')->get();
    }

    public function cancelRequest(Request $request)
    {
        Requests::where('id', '=', $request['id'])->update(['status'=>'cancelled']);
    }
}
