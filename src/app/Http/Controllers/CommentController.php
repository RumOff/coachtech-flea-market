<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $item_id)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $item_id,
            'comment' => $request->comment,
        ]);
        return back();
    }
}
