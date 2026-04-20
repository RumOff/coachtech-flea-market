<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        // 認証直後だけ
        if (session('verified_redirect')) {
            session()->forget('verified_redirect');
            return redirect('/mypage/profile');
        }

        // 未認証
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return redirect()->intended('/');
    }
}
