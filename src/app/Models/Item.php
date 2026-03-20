<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'is_sold',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
