<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    //

    /**
     * This method makes the 1: N relationship with the product_photos table
     * Este metodo faz o relacionamento  de 1 : N com a tabela product_photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
