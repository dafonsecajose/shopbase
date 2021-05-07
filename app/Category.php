<?php

namespace App;


use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    //
    use SlugTrait;

    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $fillable = ['name', 'description', 'active'];


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
