<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreContactRequest;
use App\Interfaces\ContactInterface;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return $this->contact->index();
    }

    public function submitForm(StoreContactRequest $request)
    {
        return $this->contact->submitForm($request);
    }
}
