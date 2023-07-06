<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    use Translatable;

    protected $with = ['translations'];

    protected array $translatedAttributes = ['name'];

    protected $fillable = ['attribute_id','product_id','price'];

    protected $hidden = ['translations'];

    protected $casts = [
        'is_translatable' => 'boolean'
    ];


    






    public function product () {
        return $this->belongsTo(Product::class); 
    }

    public function attribute () {
        return $this->belongsTo(Attribute::class); 
    }

}
