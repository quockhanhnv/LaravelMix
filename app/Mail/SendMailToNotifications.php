<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToNotifications extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('quockhanhnv0209@gmail.com')
            ->subject('Notification of App')
            ->view('emails.MailToNotification')
            ->with([
                'title' => $this->title,
                'content' => $this->content,
            ]);
    }
}
