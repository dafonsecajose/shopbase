<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    /**
     * This method makes the 1: N relationship with the product_photos table
     * Este metodo faz o relacionamento  de 1 : N com a tabela product_photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * This method makes the 1: N relationship with the product_photos table
     * Este metodo faz o relacionamento  de 1 : N com a tabela product_photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
