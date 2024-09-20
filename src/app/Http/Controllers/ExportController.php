<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $date = $request->input('date');

        $contacts = Contact::query()
            ->when($query, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when($date, function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->get();

        $csvFileName = 'contacts_export_' . now()->format('YmdHis') . '.csv';

        $response = new StreamedResponse(function() use ($contacts) {
            $handle = fopen('php://output', 'w');

            // CSV ヘッダー
            fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Category', 'Created At']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->first_name,
                    $contact->last_name,
                    $contact->email,
                    $contact->category->content ?? '未指定',
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $csvFileName . '"');

        return $response;
    }
}