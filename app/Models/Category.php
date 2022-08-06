<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'photo',
        'status'
    ];

    protected $dateFormat = 'Y-m-d';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
