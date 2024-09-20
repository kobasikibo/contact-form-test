<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // ユーザー登録ページの表示
    public function showRegisterForm()
    {
        return view('register');
    }

    // ユーザー登録の処理
    public function register(RegisterRequest $request)
    {
        // ユーザー作成
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録成功後、ログインページへリダイレクト
        return redirect('/login')->with('success', 'ユーザー登録が完了しました');
    }
}