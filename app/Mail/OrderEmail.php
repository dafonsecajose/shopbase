<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Integer;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $op;

    /**
     * Create a new message instance.
     *
     * @return void
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
                    ->view('email.order')->with(['user' => $this->user, 'option' => $this->op['option']]);
    }
}
