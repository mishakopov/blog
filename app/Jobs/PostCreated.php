<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreated as PostCreatedMail;

class PostCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $postTitle;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $postTitle)
    {
        $this->user = $user;
        $this->postTitle = $postTitle;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user)->send(new PostCreatedMail($this->postTitle));
    }
}
