<?php

namespace App\Http\Controllers;

use App\Queue;
use App\Bracket;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['datefrom']=='' && $request['dateto']==''){
            $queue = Queue::join('users', 'queues.user_id', '=', 'users.id')
            ->select('users.name', 'queues.id', 'queues.exit', 'queues.exited')->orderBy('queues.id', 'ASC')->paginate(5);
        }
        else{
            $queue =  Queue::join('users', 'queues.user_id', '=', 'users.id')
            ->select('users.name', 'queues.id', 'queues.exit', 'queues.exited')->whereDate('queues.created_at', '>=', $request['datefrom'])->whereDate('queues.id', '<=', $request['dateto'])->orderBy('queues.created_at', 'ASC')->paginate(5);
        }
        return response()->json(['data'=>$queue]);
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
        return Queue::create([
            'user_id' => $request['user_id'],
            'exit' => $request['exit'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show(Queue $queue)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queue $queue)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function getBracket(Request $request)
    {
        $queues= Queue::where('user_id', '=', $request['id'])->latest()->get();
        foreach ($queues as $queue) {
            $brackets = Bracket::all();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function getUser(Request $request, $id)
    {
        $users= Queue::where('id', '=', $id)
        ->get();
        foreach ($users as $user) {
            $idd= $user->user_id;
        }
        return response()->json(['data'=>$idd]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function getTotal(Request $request)
    {
        $users= Queue::all();
        foreach ($users as $user) {
            $idd= $user->id;
        }
        return response()->json(['data'=>$idd]);
    }

    public function configNumber(Request $request)
    {
        $dta=array();
        // $queues=Queue::where('exited', '=', '0')->get();
        $myqueues=Queue::where('user_id', '=', $request['id'])->where('exited', '=', '0')->get();
        $currentBracket = Bracket::all();
        foreach ($currentBracket as $currentBracket) {
            $currentID= $currentBracket->currentBracket;
            $currentcount= $currentBracket->bracketCount;
            $currentexit= $currentBracket->exit;
        }
        foreach ($myqueues as $myqueues) {
            if ($myqueues->id == $currentID){
                $myexit=Queue::where('id', '=', $myqueues->id)->value('exit');
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
                $num1=Queue::where('id', '<', $myqueues->id)->where('exited', '=', '0')->sum('exit');
                $num2=Queue::where('id', '<=', $myqueues->id)->where('exited', '=', '0')->sum('exit');
                $myexit=Queue::where('id', '=', $myqueues->id)->value('exit');
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