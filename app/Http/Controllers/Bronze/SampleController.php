<?php

namespace App\Http\Controllers\Bronze;

use App\User;
use App\Genealogy;
use App\GenealogyMatchPoint;
use App\GenealogyMatchLog;
use App\Wallets as Wallet;
use App\WalletLogs as WalletLog;
use App\Informations;
use App\UserAccountStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SampleController extends Controller
{
    public function test() {
        $samples = [
            [
                "name" => "SecureLife01",
                "email" => "SecureLife01@SecureLife.com"
            ],
            [
                "name" => "SecureLife02",
                "email" => "SecureLife02@SecureLife.com"
            ],
            [
                "name" => "SecureLife03",
                "email" => "SecureLife03@SecureLife.com"
            ],
            [
                "name" => "SecureLife04",
                "email" => "SecureLife04@SecureLife.com"
            ],
            [
                "name" => "SecureLife05",
                "email" => "SecureLife05@SecureLife.com"
            ],
            [
                "name" => "SecureLife06",
                "email" => "SecureLife06@SecureLife.com"
            ],
            [
                "name" => "SecureLife07",
                "email" => "SecureLife07@SecureLife.com"
            ],
        ];
        $id = 1;
        foreach($samples as $item) {
            $user = User::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'username' => $item['name'],
                'role_id' => 2,
                'type' => 'bronze',
                'status' => 'active',
                'code' => 'SLB-'.str_pad($id,5,0,STR_PAD_LEFT),
                'password' => bcrypt('12341234'),
            ]);

            $name = explode(" ", $item['name']);
            Informations::create([
                'user_id' => $user->id,
                'firstname' => $name[0],
                'lastname' => $name[0],
                'mi' => '',
                'photo' => 'utin.png',
                'address' => '',
                'birthdate' => '',
                'contact' => '',
            ]);

            UserAccountStatus::create([
                'user_id' => $user->id, 
                'status' => 'active',
            ]);
            $id++;
        }

        Genealogy::insert(
            array(
                array('user_id' => 1, 'reference_id' => NULL, 'referal_id' => NULL, 'position' => 'Root',),
                array('user_id' => 2, 'reference_id' => 1, 'referal_id' => 1, 'position' => 'Left',),
                array('user_id' => 3, 'reference_id' => 1, 'referal_id' => 1, 'position' => 'Right',),
                array('user_id' => 4, 'reference_id' => 2, 'referal_id' => 2, 'position' => 'Left',),
                array('user_id' => 5, 'reference_id' => 2, 'referal_id' => 2, 'position' => 'Right',),
                array('user_id' => 6, 'reference_id' => 3, 'referal_id' => 3, 'position' => 'Left',),
                array('user_id' => 7, 'reference_id' => 3, 'referal_id' => 3, 'position' => 'Right',),
            )
        );

        GenealogyMatchPoint::insert(
            array(
                array('genealogy_id' => 1, 'matches' => 3),
                array('genealogy_id' => 2, 'matches' => 1),
                array('genealogy_id' => 3, 'matches' => 1),
                array('genealogy_id' => 4, 'matches' => 0),
                array('genealogy_id' => 5, 'matches' => 0),
                array('genealogy_id' => 6, 'matches' => 0),
                array('genealogy_id' => 7, 'matches' => 0),
            )
        );

        Wallet::insert(
            array(
                array('user_id' => 1, 'total_earnings' => 3250, 'current_balance' => 2925),
                array('user_id' => 2, 'total_earnings' => 1750, 'current_balance' => 1575),
                array('user_id' => 3, 'total_earnings' => 1750, 'current_balance' => 1575),
                array('user_id' => 4, 'total_earnings' => 0, 'current_balance' => 0),
                array('user_id' => 5, 'total_earnings' => 0, 'current_balance' => 0),
                array('user_id' => 6, 'total_earnings' => 0, 'current_balance' => 0),
                array('user_id' => 7, 'total_earnings' => 0, 'current_balance' => 0),
            )
        );

        WalletLog::insert(
            array(
                array('wallet_id' => 1, 'amount' => 500, 'remarks' => 'Referal Reward'),
                array('wallet_id' => 1, 'amount' => 750, 'remarks' => 'Match Point Reward'),
                array('wallet_id' => 1, 'amount' => 500, 'remarks' => 'Referal Reward'),
                array('wallet_id' => 2, 'amount' => 500, 'remarks' => 'Referal Reward'),
                array('wallet_id' => 2, 'amount' => 750, 'remarks' => 'Match Point Reward'),
                array('wallet_id' => 2, 'amount' => 500, 'remarks' => 'Referal Reward'),
                array('wallet_id' => 1, 'amount' => 750, 'remarks' => 'Match Point Reward'),
                array('wallet_id' => 3, 'amount' => 500, 'remarks' => 'Referal Reward'),
                array('wallet_id' => 3, 'amount' => 750, 'remarks' => 'Match Point Reward'),
                array('wallet_id' => 1, 'amount' => 750, 'remarks' => 'Match Point Reward'),
                array('wallet_id' => 3, 'amount' => 500, 'remarks' => 'Referal Reward'),
            )
        );

        GenealogyMatchLog::insert(
            array(
                array('user_id' => 1, 'genealogy_id' => 1, 'remarks' => 'New Match!'),
                array('user_id' => 1, 'genealogy_id' => 2, 'remarks' => 'New Match!'),
                array('user_id' => 1, 'genealogy_id' => 1, 'remarks' => 'New Match!'),
                array('user_id' => 1, 'genealogy_id' => 3, 'remarks' => 'New Match!'),
                array('user_id' => 1, 'genealogy_id' => 1, 'remarks' => 'New Match!'),
            )
        );
    }
}
