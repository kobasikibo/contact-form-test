@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <style>
        /* 詳細情報のスタイル */
        .details {
            display: none;
        }

        .details:target {
            display: block;
            margin-left: 20px;
            padding: 10px;
            background-color: #f0f0f0;
        }

        .delete-button {
            color: red;
            cursor: pointer;
        }

        .close-button {
            display: inline-block;
            margin: 10px 0;
            cursor: pointer;
            color: blue;
        }
    </style>
@endsection

@section('title', 'Admin')

@section('nav-links')
    <nav>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="button">logout</button>
        </form>
    </nav>
@endsection

@section('content')
    <h2>Admin</h2>

    <div class="content">
        <!-- 検索フォーム -->
        <form method="GET" action="{{ route('admin.search') }}" class="form-search">
            @csrf
            <div>
                <input id="query" type="text" name="query" placeholder="名前やメールアドレスを入力してください。" value="{{ request('query') }}">
            </div>
            <div>
                <select id="gender" name="gender">
                    <option value="" {{ request('gender') == '' ? 'selected' : '' }}>性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div>
                <select id="category" name="category">
                    <option value="" {{ request('category') == '' ? 'selected' : '' }}>お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="date" id="date" name="date" value="{{ request('date') }}">
            </div>
            <button type="submit" class="search-button">検索</button>
            <a href="{{ route('admin.search', ['query' => '', 'category' => '', 'gender' => '', 'date' => '']) }}" class="reset-button">リセット</a>
        </form>

        <!-- エクスポートボタンとページネーション -->
        <div class="export-pagination-container">
            <form action="{{ route('export') }}" method="GET">
                @csrf
                <input type="hidden" name="query" value="{{ request('query') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button type="submit" class="export-button">エクスポート</button>
            </form>
            {{ $contacts->appends(request()->query())->links('vendor.pagination.simple') }}
        </div>

        <!-- 検索結果 -->
        @if($contacts->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                            <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category ? $contact->category->content : '未指定' }}</td>
                            <td><a href="#details{{ $contact->id }}" class="show-details">詳細</a></td>
                        </tr>

                        <!-- 詳細情報の表示 -->
                        <div id="details{{ $contact->id }}" class="details">
                            <button class="close-button" onclick="document.getElementById('details{{ $contact->id }}').style.display='none'; return false;">⊗</button>
                            <p><span class="label">お名前</span><span class="data">{{ $contact->last_name }} {{ $contact->first_name }}</span></p>
                            <p><span class="label">性別</span><span class="data">{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</span></p>
                            <p><span class="label">メールアドレス</span><span class="data">{{ $contact->email }}</span></p>
                            <p><span class="label">電話番号</span><span class="data">{{ $contact->tell }}</span></p>
                            <p><span class="label">住所</span><span class="data">{{ $contact->address }}</span></p>
                            <p><span class="label">建物名</span><span class="data">{{ $contact->building }}</span></p>
                            <p><span class="label">お問い合わせの種類</span><span class="data">{{ $contact->category ? $contact->category->content : '未指定' }}</span></p>
                            <p><span class="label">お問い合わせ内容</span><span class="data">{{ $contact->detail }}</span></p>
                            <form action="/contacts/{{ $contact->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">削除</button>
                            </form>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>検索結果がありません。</p>
        @endif
    </div>
@endsection