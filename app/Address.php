<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package App
 */
class Address extends Model
{
    use HasFactory;

    /**
     * Table name
     * @var string
     */
    protected $table = 'adresses';

    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $fillable = ['street', 'neighborhood', 'house_code', 'zip_code',
        'city', 'state', 'address_type'];

    /**
     * This method makes the 1: N relationship with the users table
     * Este metodo faz o relacionamento  de 1 : N com a tabela users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
