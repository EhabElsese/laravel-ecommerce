<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    use Translatable;

    protected $with = ['translations'];

    protected array $translatedAttributes = ['name'];

    protected $fillable = ['is_active','photo'];

    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive ($query) {

        return $query->where('is_active',1);
    }

    static function photoAttr($val){

        return ($val !== null) ? asset('assets/images/brands/'.$val) : "" ;
    }


    public function cat_status (){

        return $this-> is_active === false  ? "غير مفعل  " : 'مفعل' ;
    }


}
