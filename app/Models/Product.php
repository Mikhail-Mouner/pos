<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $appends = ['image_path','profit_percent'];
    protected $fillable = ['category_id','image','purchase_price','sale_price','stock'];
    public $translatedAttributes = ['name','description'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function getImagePathAttribute($value)
    {
        return asset('uploads/product_images/'.$this->image);
    }
    public function getProfitPercentAttribute($value)
    {
        return number_format(($this->sale_price - $this->purchase_price) * 100 / $this->purchase_price,2).' %';
    }
}
