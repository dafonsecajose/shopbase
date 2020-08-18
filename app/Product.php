<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Product extends Model
{
    //

   use Slug;

    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $fillable = ['name', 'resume', 'description', 'price', 'height', 'width',
        'weight', 'depth', 'amount', 'active'];

    public function getThumbAttribute(){
        return $this->photos()->where('cover', 'OK');
    }


    /**
     * This method makes the N: N relationship with the categories table
     * Este metodo faz o relacionamento  de N : N com a tabela categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * This method makes the 1: N relationship with the itens_order table
     * Este metodo faz o relacionamento  de 1 : N com a tabela itens_order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function item()
    {
        return $this->hasMany(ItemOrder::class);
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
