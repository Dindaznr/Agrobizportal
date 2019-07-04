<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'resi_number', 'customer_id', 'address_id', 'seller_id',
        'status', 'type', 'payment', 'description', 'delivery_date', 'end_date'
    ];

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
