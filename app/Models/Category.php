<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, LogsActivity;

    //protected $fillable = ['name'];
    public $translatedAttributes = ['name','products_count'];

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function getProductsCountAttribute($value)
    {
        return $this->products()->count();
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = " $this->name ({$eventName})";
        $activity->log_name = __('details.category');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ;
    }
}
