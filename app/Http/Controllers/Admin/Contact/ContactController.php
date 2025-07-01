<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::when(request()->keyword, function (Builder $query) {
            $query->where('name', 'like', '%' . request()->keyword . '%')
                ->orWhere('email', 'like', '%' . request()->keyword . '%')
                ->orWhere('phone', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }


    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return to_route('admin.contacts.index')->with('success', 'deleted successfully.');
    }
}
