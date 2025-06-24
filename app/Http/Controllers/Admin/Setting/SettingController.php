<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        return $request;
    }
}
