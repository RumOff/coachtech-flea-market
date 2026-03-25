<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show()
    {
        return view('purchase.show');
    }
}
