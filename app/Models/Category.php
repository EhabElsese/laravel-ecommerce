<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    protected $with = ['translations'];

    protected array $translatedAttributes = ['name'];

    protected $fillable = ['slug','is_active','parent_id '];

    protected $hidden = ['translations'];

    protected $casts = [
        'is_translatable' => 'boolean'
    ];


    public function cat_status (){

       return $this-> is_active == 0  ? "غير مفعل  " : 'مفعل' ;
    }


}
