<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // お問い合わせフォームの表示
    public function create()
    {
        $categories = Category::all();
        return view('contact.create', compact('categories'));
    }

    // お問い合わせ内容の確認画面
    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();

        $contact['tell'] = $contact['tell_part1'] . $contact['tell_part2'] . $contact['tell_part3'];
        $contact['name'] = $contact['last_name'] . '　' . $contact['first_name'];
        $contact['category'] = Category::find($contact['category_id']);

        $request->session()->put('contact', $contact);

        return view('contact.confirm', compact('contact'));
    }

    // 修正画面の表示
    public function edit(Request $request)
    {
        $contact = $request->session()->get('contact', []);

        if (!empty($contact['tell'])) {
            $contact['tell_part1'] = substr($contact['tell'], 0, 3);
            $contact['tell_part2'] = substr($contact['tell'], 3, 4);
            $contact['tell_part3'] = substr($contact['tell'], 7);
        } else {
            $contact['tell_part1'] = '';
            $contact['tell_part2'] = '';
            $contact['tell_part3'] = '';
        }

        $categories = Category::all();

        return view('contact.create', compact('contact', 'categories'));
    }

    public function store(Request $request)
    {
        $contact = $request->session()->get('contact', []);

        if (empty($contact)) {
            return redirect('/')->withErrors('セッションのデータが見つかりません');
        }

        $tell = $contact['tell_part1'] . $contact['tell_part2'] . $contact['tell_part3'];

        Contact::create([
            'last_name' => $contact['last_name'],
            'first_name' => $contact['first_name'],
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'tell' => $tell,
            'address' => $contact['address'],
            'building' => $contact['building'],
            'category_id' => $contact['category_id'],
            'detail' => $contact['detail']
        ]);

        $request->session()->forget('contact');

        return redirect('/thanks');
    }

    // サンクスページの表示
    public function thanks()
    {
        return view('contact.thanks');
    }
}