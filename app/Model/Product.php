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
        'created_by', 'updated_by',
        'name', 'slug', 'description', 'image', 'price', 'stock', 'active',
        'rate_count', 'sale_counts'
    ];

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
