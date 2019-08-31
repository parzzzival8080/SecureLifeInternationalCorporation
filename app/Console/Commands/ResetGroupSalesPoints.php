<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use App\User;
use App\UserProductLog;

class ResetGroupSalesPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:resetgroupsalespoints';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets group sales points every month, if condition is met';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user_list = User::all();
        foreach ($user_list as $user) {
            $previousMonth = new DateTime(date('Y-m', strtotime('-1 month')));
            $maintained = UserProductLog::where('user_id', $user->id)->whereBetween('created_at', [$previousMonth->format('Y-m-')."01", $previousMonth->format('Y-m-t')])->sum('total');
            $check = $maintained < 1500 ? true : false;

            if($check) {
                $genealogyMatchPoint =  $user->genealogy->genealogyMatchPoint;
                $genealogyMatchPoint->left_group_sales_points = 0;
                $genealogyMatchPoint->right_group_sales_points = 0;
                $genealogyMatchPoint->save();
            }
        }
    }
}
