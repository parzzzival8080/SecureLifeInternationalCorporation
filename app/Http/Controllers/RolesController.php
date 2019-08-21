<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $sample = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'developer'
            ],
            [
                'name' => 'user'
            ],
        ];
        if (Roles::all()->count()==0)
        {
            foreach ($sample as $sample)
            {
                Roles::create($sample);
            }
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Roles $roles)
    {
        //
    }

    public function edit(Roles $roles)
    {
        //
    }

    public function update(Request $request, Roles $roles)
    {
        //
    }

    public function destroy(Roles $roles)
    {
        //
    }
}
