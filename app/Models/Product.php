<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_type',
        'seller_id',
        'name',
        'slug',
        'summary',
        'category',
        'subcategory',
        'price',
        'compare_price',
        'product_image',
        'visibility',
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }


    // Product.php
    public function category()
    {
        return $this->belongsTo(Category::class, 'id'); 
    }


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'id');
    }


}
