<?php

namespace App\Http\Controllers;

use App\Keys;
use App\Roles;
use App\Sponsorships;
use App\User;
use App\WalletLogs;
use App\Wallets;
use Illuminate\Http\Request;
use Lcobucci\JWT\Signer\Key;

class WalletsController extends Controller
{
    public function store(Request $request)
    {
        Wallets::create($request->all());
    }

    public function getEarnings(Request $request)
    {
        $totalinvite = WalletLogs::where('wallet_id', '=', Wallets::where('user_id', '=', $request['id'])->value('id'))->where('remarks', '=', 'Direct Referral Reward')->sum('amount');
        $totalexit = WalletLogs::where('wallet_id', '=', Wallets::where('user_id', '=', $request['id'])->value('id'))->where('remarks', '=', 'Exit Reward')->sum('amount');
        $totalearning = Wallets::where('user_id', '=', $request['id'])->value('total_earnings');
        $availableencash = Wallets::where('user_id', '=', $request['id'])->value('current_balance');
        $totalencash = WalletLogs::where('wallet_id', '=', Wallets::where('user_id', '=', $request['id'])->value('id'))->where('remarks', '=', 'Encashment')->sum('amount');
        $money = WalletLogs::where('wallet_id', '=', Wallets::where('user_id', '=', $request['id'])->value('id'))->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'totalearnings' => $totalearning,
            'availableencash' => $availableencash,
            'totalinvite' => $totalinvite - ($totalinvite*.1),
            'totalexit' => $totalexit - ($totalexit*.1),
            'totalencash' => $totalencash,
            'money'=>$money
        ]);
    }

    public function referralActivated(Request $request)
    {
        $sponsor_id = Sponsorships::where('user_id', '=', $request['id'])->value('sponsor_id');
        $sponsor_type = Roles::where('id', '=', User::where('id', '=', $sponsor_id)->value('role_id'))->value('name');
        if (strtoupper($sponsor_type) != 'ADMIN')
        {
            $investment = Keys::where('key', '=', $request['code'])->value('investment');
            $wallet_id = Wallets::where('user_id', '=', $sponsor_id)->value('id');
            $total_earnings = Wallets::where('user_id', '=', $sponsor_id)->value('total_earnings');
            if ($wallet_id == 0)
            {
                $wallet_id=Wallets::create([
                    'user_id' => $sponsor_id,
                    'total_earnings'=>$investment * .05,
                    'current_balance'=>($investment * .05) - ($investment * .05 *.10),
                ])->value('id');
            }
            else
            {
                $total_earnings += $investment * .05;
                Wallets::where('id', '=', $wallet_id)->update([
                    'total_earnings' => $total_earnings,
                    'current_balance'=> $total_earnings - ($total_earnings *.10),
                ]);
            }
            WalletLogs::create([
                'wallet_id' => $wallet_id,
                'amount' => $investment * .05,
                'remarks' => 'Direct Referral Reward',
            ]);
        }

        $notifcontroller = new NotificationsController;
        $notifcontroller->userActivated($request);
        return $total_earnings;
    }
}
