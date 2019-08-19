<?php

namespace App\Http\Controllers;

use App\Proof;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\User;
use App\Key;
use App\Notif;
use App\Queue;

class ProofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        Cloudder::upload($request['image'], null, ['folder'=>'SecureLife/proofs_test/']);
        $request['image'] = Cloudder::show(Cloudder::getPublicId());

        $proof = Proof::create($request->all());

        $request['proof_id']=$proof->id;
        
        $notifcontroller = new NotifController;
        $notifcontroller->KeyRequest($request);
        $msg = true;
        return response()->json(['data'=>$msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proof  $proof
     * @return \Illuminate\Http\Response
     */
    public function show(Proof $proof)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proof  $proof
     * @return \Illuminate\Http\Response
     */
    public function edit(Proof $proof)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proof  $proof
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proof $proof)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proof  $proof
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proof $proof)
    {
        //
    }

    public function getRequests(Request $request)
    {
        $returnproofs = array();
        $proofs = Proof::all();
        foreach ($proofs as $proofs)
        {
            $proofs->user_id = User::where('id', '=', $proofs->user_id)->value('name');
            array_push($returnproofs, $proofs);
        }
        return $returnproofs;
    }

    public function approveRequest(Request $request)
    {
        Proof::where('id', '=', $request['proof_id'])->update(['status'=>'approved', 'investment'=>$request['investment']]);
        
        $request['user_id'] = User::where('email', '=', $request['user_id'])->value('id');
        
        $keycontroller = new KeyController;
        $keyID = $keycontroller->store($request);
        
        $notify = Queue::where('user_id', '=', $request['user_id'])->get();
        
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
        Proof::where('id', '=', $request['proof_id'])->update(['status'=>'disapproved']);
        
        $request['user_id'] = User::where('email', '=', $request['user_id'])->value('id');

        $notify = Queue::where('user_id', '=', $request['user_id'])->get();
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
        return Proof::where('user_id', '=', $request['id'])->where('status', '<>', 'approved')->get();
    }

    public function cancelRequest(Request $request)
    {
        Proof::where('id', '=', $request['id'])->update(['status'=>'cancelled']);
    }
}
