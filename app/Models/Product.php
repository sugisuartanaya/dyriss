<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'product_name',
        'price',
        'qty',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
