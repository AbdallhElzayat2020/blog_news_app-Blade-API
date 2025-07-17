<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\SendOtpVerifyUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class SendOtpTask implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $tries = 2;
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new SendOtpVerifyUserEmail());
    }
}
