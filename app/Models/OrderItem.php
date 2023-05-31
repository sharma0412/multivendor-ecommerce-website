<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class OrderItem extends Model
{
    use HasFactory,Uuids;
    protected $table = 'order_item';
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
     public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    
}
