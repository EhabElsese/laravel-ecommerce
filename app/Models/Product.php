<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
     softDeletes,
        Translatable;



    protected $with = ['translations'];


    protected $fillable = [
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active'
    ];


    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];




    protected $translatedAttributes = ['name', 'description', 'short_description'];

    public function cat_status (){

        return $this-> is_active == 0  ? "غير مفعل  " : 'مفعل' ;
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }


    static function photoAttr($val){

        return ($val !== null) ? asset('assets/images/products/'.$val) : "" ;
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function scopeActive ($query){

        return $query->where('is_active',1);
    }


    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function hasStock($quantity)
    {
        return $this->qty >= $quantity;
    }

    public function outOfStock()
    {
        return $this->qty === 0;
    }

    public function inStock()
    {
        return $this->qty >= 1;
    }


public function getTotal($converted = true)
    {
        return $total =  $this->special_price ?? $this -> price;

    }
}
