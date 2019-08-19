<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallets;
use Illuminate\Http\Request;

class WalletsController extends Controller
{
    public function store(Request $request)
    {
        Wallets::create($request->all());
    }

    public function getEarnings(Request $request)
    {
        $totalinvite = Wallets::where('user_id', '=', $request['id'])->where('remarks', '=', 'Direct Referral')->sum('amount');
        $totalexit = Wallets::where('user_id', '=', $request['id'])->where('remarks', '=', 'Exit')->sum('amount');
        $totalearning = Wallets::where('user_id', '=', $request['id'])->where('encashed', '=', '0')->sum('amount');
        $totalencash = Wallets::where('user_id', '=', $request['id'])->where('encashed', '=', '1')->sum('amount');
        $money = Wallets::where('user_id', '=', $request['id'])->orderBy('created_at', 'DESC')->get();
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
            Wallets::create([
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
