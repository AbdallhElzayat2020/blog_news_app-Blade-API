<?php

namespace App\Repositories;

use App\Interfaces\ContactInterface;
use App\Models\Contact;
use Illuminate\View\View;

class ContactRepository implements ContactInterface
{
    public function index(): View
    {
        return view('frontend.contact');
    }

    public function submitForm($request): \Illuminate\Http\RedirectResponse
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