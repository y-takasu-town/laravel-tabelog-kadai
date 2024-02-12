<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Store extends Model
{
    use HasFactory, Sortable;

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
        'image',
    ];

    public $sortable = [
        'price_range', 
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
