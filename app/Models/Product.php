<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productFeatures()
    {
        return $this->hasMany(ProductFeature::class, 'product_id', 'id')
            ->orderBy('product_features.rank', 'ASC');
    }

    public function getPriceAttribute($value)
    {
        return number_format($value / 100, 2);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int)($value * 100);
    }

}
