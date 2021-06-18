<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    //protected $fillable = ['name'];
    public $translatedAttributes = ['name','products_count'];

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function getProductsCountAttribute($value)
    {
        return $this->products()->count();
    }
}
