<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','product_id','qty','total_price'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class,'product_order')->withPivot('qty');
    }



}
