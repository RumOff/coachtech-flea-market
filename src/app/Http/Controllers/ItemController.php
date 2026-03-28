<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('tab');
        $query = Item::select('id','name','image')
            ->orderBy('created_at','desc');
            
        // ログイン時は自分の商品を除外
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        // マイリストタブ
        if ($page === 'mylist') {
            $items = auth()->user()->likedItems()
            ->select('items.id', 'name', 'image')
            ->orderBy('items.created_at', 'desc')
            ->get();
        } else {
            // 通常タブ
            $items = $query->get();
        }

        return view('items.index', compact('items', 'page'));
    }

    public function show($item_id)
    {
        $item = Item::detail()->findOrFail($item_id);

        return view('items.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('items.sell', compact('categories'));
    }

    public function store(Request $request)
    {
        
        $imagePath = $request->file('image')->store('items', 'public');
        
        Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_sold' => false,
            'condition' => $request->condition,
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'image' => $imagePath,
        ]);

        return Redirect('/');
    }
}
