@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('title', 'Login')

@section('nav-links')
    <nav>
        <a href="{{ route('register') }}" class="button">register</a>
        @csrf
    </nav>
@endsection


@section('content')
    <h2>Login</h2>

    <form action="{{ route('login') }}" method="POST" novalidate>
        @csrf
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com" required>
        @error('email')
            <div class="login__alert-danger">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" placeholder="例: coachtech1106" required>
        @error('password')
            <div class="login__alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-button-container">
            <button type="submit">ログイン</button>
        </div>
    </form>
@endsection