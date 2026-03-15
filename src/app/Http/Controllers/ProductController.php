<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id','name','image')
            ->orderBy('created_at','desc')
            ->get();

        return view('index', compact('products'));
    }

    public function show($item_id)
    {
        $product = Product::findOrFail($item_id);

        return view('show', compact('product'));
    }
}
