<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'price',
        'quantity', 'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function scopeOrder (Builder $query, $id) {
        return $query->whereHas('order', function ($q) use ($id) {
                $q->where('id', $id);
        });
    }
}
