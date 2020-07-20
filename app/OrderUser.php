<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUser extends Model
{
    //

    /**
     * This method makes the 1: N relationship with the user table
     * Este metodo faz o relacionamento  de 1 : N com a tabela user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
