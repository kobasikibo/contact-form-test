<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ログインページの表示
    public function showLoginForm()
    {
        return view('login');
    }

      // ログイン処理
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログイン成功後、ダッシュボードやメインページへリダイレクト
            return redirect()->intended('/admin')->with('success', 'ログインしました');
        }

        // ログイン失敗時のリダイレクト
        return redirect('/login')->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています']);
    }
}