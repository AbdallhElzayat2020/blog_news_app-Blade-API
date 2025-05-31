<?php

namespace App\Repositories;

use App\Interfaces\SubscribersInterface;
use App\Mail\Frontend\NewsSubscriberMail;
use App\Models\NewsSubscriber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SubscribersRepository implements SubscribersInterface
{
    public function index($request)
    {
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
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'You have successfully subscribed to our newsletter.');
    }
}