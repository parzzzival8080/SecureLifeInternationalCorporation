<?php

namespace App\Http\Controllers\Diamond;

use App\CurrentQueue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrentQueueController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $bracket = CurrentQueue::findOrFail(1);
            $bracket->update($request->all());
        }
        catch(ModelNotFoundException $e)
        {
            return CurrentQueue::create($request->all());
        }
    }

    public function getActiveBracket(Request $request)
    {
        $users= CurrentQueue::latest()->get();
        foreach ($users as $user) {
            return response()->json(['data'=>$user->currentBracket, 'count'=> $user->bracketCount]);
        }
    }
}
