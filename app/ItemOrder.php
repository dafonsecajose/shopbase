<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    //

    protected $table ='items_order';
    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $fillable = ['product_id', 'price', 'amount'];

    /**
     * This method makes the 1: N relationship with the products table
     * Este metodo faz o relacionamento  de 1 : N com a tabela products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * This method makes the 1: N relationship with the order table
     * Este metodo faz o relacionamento  de 1 : N com a tabela order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(OrderUser::class);
    }
}
