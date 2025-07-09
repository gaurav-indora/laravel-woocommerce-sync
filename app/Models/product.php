<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{       
    protected $table = 'product';
    protected $primaryKey = 'product_id';

     protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'woocommerce_id'
    ];
}
