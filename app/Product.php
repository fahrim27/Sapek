<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use BeyondCode\Vouchers\Traits\Vouchers;

/**
 * Class Product
 *
 * @package App
 * 
*/
class Product extends Model
{   
    use SoftDeletes;

    protected $fillable = ['name', 'stock', 'model', 'price', 'primary_image', 'slug', 'descriptions'];
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPriceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['price'] = $input;
        } else {
            $this->attributes['price'] = null;
        }
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id')->withTrashed();
    }

    public function priceOff()
    {
        return $this->belongsTo(PriceOff::class, 'id', 'pro_id')->withTrashed();
    }
    
}
