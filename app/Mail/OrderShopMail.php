<?php

namespace App\Mail;

use App\OrderUser;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShopMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $option;
    private $orderUser;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param array $option
     * @param OrderUser $orderUser
     */
    public function __construct(User $user, Array $option, OrderUser $orderUser)
    {
        $this->user = $user;
        $this->option = $option;
        $this->orderUser = $orderUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->name)
                    ->subject($this->option['subject'])
                    ->replyTo(env('MAIL_FROM_ADDRESS'))
                    ->view('email.orderShop', ['option' => $this->option , 'orderUser' => $this->orderUser]);
    }
}
