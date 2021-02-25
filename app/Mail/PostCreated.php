<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $postTitle;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postTitle)
    {
        $this->postTitle = $postTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Post Create')->view('emails.post_created')
            ->with([
                'postTitle' => $this->postTitle
            ]);
    }
}
