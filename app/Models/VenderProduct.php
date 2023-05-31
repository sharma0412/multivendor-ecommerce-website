<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VenderProduct extends Model
{
    use HasFactory, Uuids;
    protected $table = 'vendor_products';

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
