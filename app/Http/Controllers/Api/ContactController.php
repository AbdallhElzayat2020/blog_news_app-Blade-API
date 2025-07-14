<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use function App\Http\Helpers\apiResponse;

class ContactController extends Controller
{


    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string'],
            'subject' => ['required', 'string', 'max:255'],
        ]);
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => $request->subject,
            'ip_address' => $request->ip(),
        ]);
        if (!$contact->save()) {
            return apiResponse(404, 'failed to create contact', null);
        }
        return apiResponse(200, 'contact created successfully', ContactResource::make($contact));
    }

}
