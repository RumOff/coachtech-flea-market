<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('tab');
        $keyword = $request->query('keyword');

        // ベースクエリ
        $query = Item::select('id', 'name', 'image', 'is_sold')
            ->orderBy('created_at', 'desc');

        // 検索条件
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }

        // ログイン時は自分の商品を除外
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        // マイリストタブ
        if ($page === 'mylist') {
            
            $items = auth()->user()->likedItems()
                ->when($keyword, function ($q) use ($keyword) {
                    $q->where(function ($qq) use ($keyword) {
                        $qq->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->orderBy('items.created_at', 'desc')
                ->get();
        } else {
            // 通常タブ(いいね順)
            $items = $query
                ->withCount('likes')
                ->when($keyword, function ($q) use ($keyword){
                    $q->where('name', 'like', '%' . $keyword . '%');
                })
                ->orderBy('likes_count', 'desc')
                ->get();
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
        $conditions = Condition::get();
        return view('items.sell', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {

        $imagePath = $request->file('image')->store('items', 'public');
        Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_sold' => false,
            'condition_id' => $request->condition_id,
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'image' => $imagePath,
        ]);

        return Redirect('/');
    }
}
