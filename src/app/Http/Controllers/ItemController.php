<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::select('id','name','image')
            ->orderBy('created_at','desc')
            ->get();

            return view('items.index', compact('items'));

    }

    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);

        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.sell');
    }

    public function store($item_id)
    {
        $items = Item::select('id', 'name', 'image')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('item.index', compact('items'));
    }
}
