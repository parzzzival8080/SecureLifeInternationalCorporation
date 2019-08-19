<?php

namespace App\Http\Controllers;

use App\Key;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
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
        Wallet::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
    
    public function getEarnings(Request $request)
    {
        $totalinvite = Wallet::where('user_id', '=', $request['id'])->where('remarks', '=', 'Direct Referral')->sum('amount');
        $totalexit = Wallet::where('user_id', '=', $request['id'])->where('remarks', '=', 'Exit')->sum('amount');
        $totalearning = Wallet::where('user_id', '=', $request['id'])->where('encashed', '=', '0')->sum('amount');
        $totalencash = Wallet::where('user_id', '=', $request['id'])->where('encashed', '=', '1')->sum('amount');
        $money = Wallet::where('user_id', '=', $request['id'])->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'totalearnings' => $totalearning,
            'availableencash' => ($totalearning - ($totalearning*.1)) + $totalencash,
            'totalinvite' => $totalinvite - ($totalinvite*.1),
            'totalexit' => $totalexit - ($totalexit*.1),
            'totalencash' => $totalencash,
            'money'=>$money
        ]);
    }

    public function referralActivated(Request $request)
    {
        $sponsor = User::where('id', '=', $request['id'])->value('sponsor');
        $sponsor_type = User::where('code', '=', $sponsor)->value('type');
        if (strtoupper($sponsor_type) != 'ADMIN')
        {
            $sponsor_id = User::where('code', '=', $sponsor)->value('id');
            $investment = Key::where('key', '=', $request['code'])->value('investment');
            Wallet::create([
                'user_id' => $sponsor_id,
                'amount' => $investment * .05,
                'remarks' => 'Direct Referral',
                'encashed' => '0'
            ]);
        }

        $notifcontroller = new NotifController;
        $notifcontroller->userActivated($request);
    }
}
