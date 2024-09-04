<?php

namespace App\Jobs;

use App\Mail\SendMessageMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendFollowingMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
protected $followerUser;
protected $followingUser;
    /**
     * Create a new job instance.
     */
    public function __construct($followingUser,$followerUser)
    {
        $this->followingUser=$followingUser;
        $this->followerUser=$followerUser;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->followingUser->email)
            ->send(new SendMessageMail($this->followingUser,$this->followerUser));
    }
}
