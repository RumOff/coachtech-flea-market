<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        $page = $request->query('page');
        
        if ($page === 'buy'){
            $items = $user->purchases;
        }else{
            $items = $user->items;
        }

        return view('mypage.index', compact('profile', 'items', 'page'));
    }

    public function edit()
    {
        $profile = auth()->user()->profile;

        return view('mypage.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->only([
            'user_name',
            'postal_code',
            'address',
            'building',
        ]);

        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');

        $user->profile->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );
        
        return redirect()->route('items.index');

    }

}
