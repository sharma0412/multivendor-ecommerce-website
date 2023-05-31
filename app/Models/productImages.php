<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class productImages extends Model
{
    use HasFactory, Uuids;

    protected $table = 'product_images';
}
