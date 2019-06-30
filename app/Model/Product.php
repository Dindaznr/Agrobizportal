<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'created_by', 'updated_by',
        'name', 'slug', 'description', 'image', 'price', 'stock', 'active',
        'rate_count', 'sale_counts'
    ];
}
