<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function notifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('unreadNotifications'));
    }

    public function readAll()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $unreadNotifications->each(function ($notification){
            $notification->markAsRead();
        });
        flash('Notificações lida com sucesso')->success();
        return redirect()->back();
    }

    public function read($notification)
    {
        $notificacao = auth()->user()->notifications()->find($notification);

        $notificacao->markAsRead();
        flash('Notificação lida com sucesso!')->success();
        return redirect()->back();
    }
}
