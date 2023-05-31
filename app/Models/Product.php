<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Product extends Model
{
    use HasFactory, Uuids;
    protected $table = 'products';

    public function catgeory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }
}
