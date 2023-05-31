<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Order extends Model
{
    use HasFactory, Uuids;
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\User', 'vendor_id', 'id');
    }

    public function orderitem()
    {
        return $this->belongsTo('App\Models\OrderItem', 'id', 'order_id');
    }
    public function useraddress()
    {
        return $this->belongsTo('App\Models\UserAddress', 'user_address_id', 'id');
    }    
}
