<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CashierController extends Controller
{
    public function index ()
    {
        $product = Product::all();
        return response()->json(['products'=>$product]);
    }
}
