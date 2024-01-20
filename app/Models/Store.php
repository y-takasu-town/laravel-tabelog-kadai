<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'category_id',
        'discription',
        'open_time',
        'close_time',
        'price_range',
        'postal_code',
        'address',
        'phone_number',
        'holiday',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
