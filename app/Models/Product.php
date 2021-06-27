<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable, LogsActivity;

    protected $appends = ['image_path','profit_percent'];
    protected $fillable = ['category_id','image','purchase_price','sale_price','stock'];
    public $translatedAttributes = ['name','description'];

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/'.$this->image);
    }
    public function getProfitPercentAttribute()
    {
        return number_format(($this->sale_price - $this->purchase_price) * 100 / $this->purchase_price,2).' %';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'product_order');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = " $this->name ({$eventName})";
        $activity->log_name = __('details.product');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','description'])
            ;
    }
}
