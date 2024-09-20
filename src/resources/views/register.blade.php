@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('title', 'Register')

@section('nav-links')
    <nav>
        <a href="{{ route('login') }}" class="button">login</a>
        @csrf
    </nav>
@endsection

@section('content')
    <h2>Register</h2>

    <form action="{{ route('register') }}" method="POST" novalidate>
        @csrf
        <label for="name">お名前</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例: 山田　太郎" required>
        @error('name')
            <div class="register__alert-danger">{{ $message }}</div>
        @enderror

        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com" required>
        @error('email')
            <div class="register__alert-danger">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" placeholder="例: coachtech1106" required>
        @error('password')
            <div class="register__alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-button-container">
            <button type="submit">登録</button>
        </div>
    </form>
@endsection