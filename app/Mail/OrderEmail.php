<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $op;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param array $op
     */
    public function __construct(User $user, Array $op)
    {
        $this->user = $user;
        $this->op = $op;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->name)
                    ->subject($this->op['subject'])
                    ->replyTo(env('MAIL_FROM_ADDRESS'))
                    ->markdown('email.order')->with(['user' => $this->user, 'option' => $this->op]);
    }
}
