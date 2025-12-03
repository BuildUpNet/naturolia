<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'meta_title',
        'meta_keywords',
        'slug',
        'short_description',
        'key_benefits',
        'description',
        'ingredient',
        'price',
        'mrp_price',
        'qnty',
        'discount',
        'best_product',
    ];
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

public function topImage()
{
    return $this->hasOne(ProductImage::class)->where('top_image', 1);
}

}
