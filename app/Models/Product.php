<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'purchase_price',
        'selling_price',
        'total_stock',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function images()
    {
        return $this->hasMany(Image::class,'product_id','id');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class,'product_id','id');
    }
}
