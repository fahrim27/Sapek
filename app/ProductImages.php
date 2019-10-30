<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductImages extends Model
{

    use SoftDeletes;

    protected $fillable = ['product_id', 'optional_images', ];

    public function imgPro()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
