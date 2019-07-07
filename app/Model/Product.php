<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use SoftDeletes;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'slug', 'description', 'image', 'price',
        'stock', 'active', 'rate_count', 'sale_counts'
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

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function orderItem()
	{
		return $this->hasMany(OrderDetail::class);
    }

    public function transfer_orders()
	{
		return $this->orderItem()->whereHas('order', function ($q) {
            $q->whereStatus('closed');
            $q->where('payment', 'transfer');
        });
    }
    
    public function cod_orders()
	{
		return $this->orderItem()->whereHas('order', function ($q) {
            $q->whereStatus('closed');
            $q->where('payment', 'cod');
        });
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
