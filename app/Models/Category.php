<?php

namespace App\Models;

use App\Models\Business;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'business_id',
        'category_name',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
