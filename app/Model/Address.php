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
        'customer_id', 'alias', 'name',
        'city', 'province', 'district',
    ];
}
