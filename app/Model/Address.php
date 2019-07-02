<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'alias', 'address_1', 'address_2',
        'city', 'province', 'district',
    ];
}
