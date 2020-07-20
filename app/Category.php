<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    /**
     * This method makes the N: N relationship with the products table
     * Este metodo faz o relacionamento  de N : N com a tabela products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
