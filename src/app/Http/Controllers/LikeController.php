<?php

namespace App\Http\Controllers;

use App\Models\Like;

class LikeController extends Controller
{
    public function store($item_id)
    {
        Like::firstOrCreate([
            'user_id' => auth()->id(),
            'item_id' => $item_id,
        ]);

        return back();
    }

    public function destroy($item_id)
    {
        Like::where('user_id', auth()->id())
            ->where('item_id', $item_id)
            ->delete();

        return back();
    }
}
