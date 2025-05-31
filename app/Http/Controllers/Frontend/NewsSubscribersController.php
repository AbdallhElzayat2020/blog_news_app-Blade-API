<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\SubscribersInterface;
use App\Mail\Frontend\NewsSubscriberMail;
use App\Models\NewsSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewsSubscribersController extends Controller
{
    public $subscribers;

    public function __construct(SubscribersInterface $subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public function index(Request $request)
    {
        return $this->subscribers->index($request);
    }
}
