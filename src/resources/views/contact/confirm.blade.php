@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('title', 'Confirm')

@section('content')
  <h2>Confirm</h2>

  <form action="/store" method="POST">
    @csrf
    <div class="confirm-container">
      <div class="confirm-row">
        <div class="confirm-label">お名前</div>
        <div class="confirm-data">{{ $contact['name'] }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label">性別</div>
        <div class="confirm-data">{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label">メールアドレス</div>
        <div class="confirm-data">{{ $contact['email'] }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label">電話番号</div>
        <div class="confirm-data">{{ $contact['tell'] }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label">住所</div>
        <div class="confirm-data">{{ $contact['address'] }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label">建物名</div>
        <div class="confirm-data">{{ $contact['building'] }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label">お問い合わせの種類</div>
        <div class="confirm-data">{{ $contact['category']->content }}</div>
      </div>
      <div class="confirm-row">
        <div class="confirm-label" id="detail">お問い合わせ内容</div>
        <div class="confirm-data">{!! nl2br(e($contact['detail'])) !!}</div>
      </div>
    </div>
    <button type="submit" class="store">送信</button>
  </form>

  <form action="/edit" method="GET">
    @csrf
    <input type="submit" value="修正" />
  </form>
@endsection