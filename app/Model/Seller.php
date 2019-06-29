<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'slug', 'description', 'image', 'status'
    ];
}