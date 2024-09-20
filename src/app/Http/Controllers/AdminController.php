<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $gender = $request->input('gender');
        $date = $request->input('date');

        $contacts = Contact::query()
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('first_name', 'LIKE', "%{$query}%")
                            ->orWhere('last_name', 'LIKE', "%{$query}%")
                            ->orWhere('email', 'LIKE', "%{$query}%");
                });
            })
            ->when($category, function ($q) use ($category) {
                $q->where('category_id', $category);
            })
            ->when($gender, function ($q) use ($gender) {
                $q->where('gender', $gender);
            })
            ->when($date, function ($q) use ($date) {
                $q->whereDate('created_at', $date);
            })
            ->paginate(7)
            ->appends($request->query());

        $categories = Category::all();

        return view('admin', [
            'contacts' => $contacts,
            'categories' => $categories,
            'request' => $request // 現在の検索条件をビューに渡す
        ]);
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        return response()->json([
            'last_name' => $contact->last_name,
            'first_name' => $contact->first_name,
            'gender' => $contact->gender,
            'email' => $contact->email,
            'tell' => $contact->tell,
            'address' => $contact->address,
            'building' => $contact->building,
            'category' => $contact->category,
            'detail' => $contact->detail,
        ]);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.search')->with('success', 'データを削除しました。');
    }
}