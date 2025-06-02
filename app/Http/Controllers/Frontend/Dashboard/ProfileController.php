<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(): View
    {
        $user = auth()->guard('web')->user();
        return view('frontend.dashboard.profile', compact('user'));
    }

    public function store(Request $request)
    {
        return $request;
    }
}
