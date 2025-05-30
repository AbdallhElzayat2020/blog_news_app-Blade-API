<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\NewsSubscriberMail;
use App\Models\NewsSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewsSubscribersController extends Controller
{
    public function index(Request $request)
    {
        //validation
        try {
            $request->validate([
                'email' => ['required', 'email', 'unique:news_subscribers,email']
            ]);

            DB::beginTransaction();

            $email = NewsSubscriber::create([
                'email' => $request->email,
            ]);

            if (!$email) {
                return redirect()->back()->with('error', 'Something went wrong, please try again later.');
            }

            Mail::to($request->email)->send(new NewsSubscriberMail());
            DB::commit();
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        //        Mail::to($request->email)->send(new NewsSubscriberMail());

        return redirect()->back()->with('success', 'You have successfully subscribed to our newsletter.');
    }
}
