<?php

namespace App\Http\Controllers;

use App\CurrentQueue;
use App\DiamondQueues;
use Illuminate\Http\Request;

class DiamondQueuesController extends Controller
{
    public function index(Request $request)
    {
        if ($request['datefrom']=='' && $request['dateto']==''){
            $queue = DiamondQueues::join('users', 'queues.user_id', '=', 'users.id')
            ->select('users.name', 'queues.id', 'queues.exit', 'queues.exited')->orderBy('queues.id', 'ASC')->paginate(5);
        }
        else{
            $queue =  DiamondQueues::join('users', 'queues.user_id', '=', 'users.id')
            ->select('users.name', 'queues.id', 'queues.exit', 'queues.exited')->whereDate('queues.created_at', '>=', $request['datefrom'])->whereDate('queues.id', '<=', $request['dateto'])->orderBy('queues.created_at', 'ASC')->paginate(5);
        }
        return response()->json(['data'=>$queue]);
    }
    
    public function store(Request $request)
    {
        return DiamondQueues::create([
            'user_id' => $request['user_id'],
            'exit' => $request['exit'],
        ]);
    }

    public function getBracket(Request $request)
    {
        $queues= DiamondQueues::where('user_id', '=', $request['id'])->latest()->get();
        foreach ($queues as $queue) {
            $brackets = CurrentQueue::all();
            foreach ($brackets as $bracket){
                if ($bracket->currentBracket == $queue->id){
                    return response()->json(['data'=>$bracket->bracketCount]);
                }
                else{
                    return response()->json(['data'=>'']);
                }
            }
        }
    }

    public function getUser(Request $request, $id)
    {
        $users= DiamondQueues::where('id', '=', $id)
        ->get();
        foreach ($users as $user) {
            $idd= $user->user_id;
        }
        return response()->json(['data'=>$idd]);
    }

    public function getTotal(Request $request)
    {
        $users= DiamondQueues::all();
        foreach ($users as $user) {
            $idd= $user->id;
        }
        return response()->json(['data'=>$idd]);
    }

    public function configNumber(Request $request)
    {
        $dta=array();
        $myqueues=DiamondQueues::where('user_id', '=', $request['id'])->where('exited', '=', '0')->get();
        $currentBracket = CurrentQueue::all();
        foreach ($currentBracket as $currentBracket) {
            $currentID= $currentBracket->currentBracket;
        }
        foreach ($myqueues as $myqueues) {
            if ($myqueues->id == $currentID){
                $myexit=DiamondQueues::where('id', '=', $myqueues->id)->value('exit');
                if ($myexit/5 == 1){
                    $data=array('num'=>'1', 'accounts'=>$myexit/5);
                }
                else
                {
                    $data=array('num'=>'1 - '.$myexit/5, 'accounts'=>$myexit/5);
                }
                array_push($dta, $data);
            }
            else{
                $num1=DiamondQueues::where('id', '<', $myqueues->id)->where('exited', '=', '0')->sum('exit');
                $myexit=DiamondQueues::where('id', '=', $myqueues->id)->value('exit');
                if ($myexit/5 == 1){
                    $data=array('num'=>$num1/5 + 1, 'accounts'=>$myexit/5);
                }
                else
                {
                    $data=array('num'=>($num1/5 + 1).' - '.(($num1/5) + ($myexit/5)), 'accounts'=>$myexit/5);
                }
                array_push($dta, $data);
            }
        }
        return response()->json(['dta'=>$dta]);   
    }
}
