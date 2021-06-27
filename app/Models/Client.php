<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Client extends Model
{
    use HasFactory,LogsActivity;
    protected $fillable = ['name','phone','address'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = " $this->name ({$eventName})";
        $activity->log_name = __('auth.client');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','phone','address'])
            ;
    }
}
