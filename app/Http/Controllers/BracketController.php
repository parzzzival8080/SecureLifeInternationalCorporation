<?php

namespace App\Http\Controllers;

use App\Bracket;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BracketController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try
        {
            $bracket = Bracket::findOrFail(1);
            $bracket->update($request->all());
        }
        catch(ModelNotFoundException $e)
        {
            return Bracket::create($request->all());
        }
    }

    public function show(Bracket $bracket)
    {
        //
    }

    public function edit(Bracket $bracket)
    {
        //
    }

    public function update(Request $request, Bracket $bracket)
    {
        //
    }

    public function destroy(Bracket $bracket)
    {
        //
    }

    public function getActiveBracket(Request $request)
    {
        $users= Bracket::latest()->get();
        foreach ($users as $user) {
            return response()->json(['data'=>$user->currentBracket, 'count'=> $user->bracketCount]);
        }
    }
}
