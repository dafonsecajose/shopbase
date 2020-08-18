<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * This method makes the 1: N relationship with the addresses table
     * Este metodo faz o relacionamento  de 1 : N com a tabela endereços
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * * This method makes the 1: N relationship with the order_user table
     * Este metodo faz o relacionamento  de 1 : N com a tabela order_user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function orders()
    {
        return $this->hasMany(OrderUser::class);
    }

    public function notifyUserOwners()
    {
        $users = $this->where('role', 'ROLER_OWNER')->get();


        $users->each->notify(new StoreReceiveNewOrder());

    }
}
