<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->profile;

        return view('mypage.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        $request->only([
            'user_name',
            'postal_code',
            'address',
            'building',
            'avatar',
        ])
        );
        
        return redirect()->route('items.index');

    }

}
