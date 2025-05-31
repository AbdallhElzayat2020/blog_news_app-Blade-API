<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function submitForm(StoreContactRequest $request)
    {
//        Contact::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'phone' => $request->phone,
//            'message' => $request->message,
//            'subject' => $request->subject,
//            'ip_address' => $request->ip(),
//        ]);

        $request->validated();
        $request->merge([
            'ip_address' => $request->ip(),
        ]);

        $contact = Contact::create($request->all());

        if (!$contact) {
            return redirect()->back()->with('error', 'There was an error sending your message. Please try again later.');
        }
        return redirect()->back()->with('success', 'Your message has been sent successfully!');


    }
}
