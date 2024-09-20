@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}" />
@endsection

@section('title', 'Contact')

@section('content')
    <h2>Contact</h2>

    <form method="POST" action="{{ url('/confirm') }}" novalidate>
        @csrf

        <!-- お名前入力 -->
        <div>
            <label class="name" for="name">お名前<span class="red">※</span></label>
            <input type="text" id="last_name" name="last_name" placeholder="例: 山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}">
            <input type="text" id="first_name" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}">
            @error('last_name')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
            @error('first_name')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 性別選択（ラジオボタン、デフォルトで男性が選択） -->
        <div>
            <label class="gender">性別<span class="red">※</span></label>
            <div>
                <input type="radio" id="male" name="gender" value="1"
                    {{ old('gender', $contact['gender'] ?? '1') == '1' ? 'checked' : '' }}> <!-- 男性がデフォルト選択 -->
                <label for="male">男性</label>

                <input type="radio" id="female" name="gender" value="2"
                    {{ old('gender', $contact['gender'] ?? '') == '2' ? 'checked' : '' }}>
                <label for="female">女性</label>

                <input type="radio" id="other" name="gender" value="3"
                    {{ old('gender', $contact['gender'] ?? '') == '3' ? 'checked' : '' }}>
                <label for="other">その他</label>
            </div>
            @error('gender')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレス入力 -->
        <div>
            <label class="email" for="email">メールアドレス<span class="red">※</span></label>
            <input type="email" id="email" name="email"  placeholder="例: test@example.com" value="{{ old('email', $contact['email'] ?? '') }}">
            @error('email')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 電話番号入力（3つの入力欄） -->
        <div>
            <label class="tell" for="tell">電話番号<span class="red">※</span></label>
            <input type="text" id="tell_part1" name="tell_part1" placeholder="080" value="{{ old('tell_part1', $contact['tell_part1'] ?? '') }}">
            <span>-</span>
            <input type="text" id="tell_part2" name="tell_part2" placeholder="1234" value="{{ old('tell_part2', $contact['tell_part2'] ?? '') }}">
            <span>-</span>
            <input type="text" id="tell_part3" name="tell_part3" placeholder="5678" value="{{ old('tell_part3', $contact['tell_part3'] ?? '') }}">
            @error('tell_part1')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
            @error('tell_part2')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
            @error('tell_part3')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 住所入力 -->
        <div>
            <label class="address" for="address">住所<span class="red">※</span></label>
            <input type="text" id="address" name="address"  placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $contact['address'] ?? '') }}">
            @error('address')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 建物入力 -->
        <div>
            <label class="building" for="building">建物名</label>
            <input type="text" id="building" name="building"  placeholder="例: 千駄ヶ谷マンション" value="{{ old('building', $contact['building'] ?? '') }}">
            @error('building')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- お問い合わせの種類選択 -->
        <div>
            <label class="category" for="category">お問い合わせの種類<span class="red">※</span></label>
            <select id="category" name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $contact['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- お問い合わせ内容 -->
        <div>
            <label class="detail" for="detail">お問い合わせ内容<span class="red">※</span></label>
            <textarea id="detail" name="detail" placeholder="例: お問い合わせ内容をご記載ください">{{ old('detail', $contact['detail'] ?? '') }}</textarea>
            @error('detail')
                <div class="create__alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 確認ボタン -->
        <div>
            <button type="submit">確認画面</button>
        </div>
    </form>
@endsection