<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Translatable;

    protected $with = ['translations'];

    protected array $translatedAttributes = ['name'];

    protected $fillable = ['slug'];

    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean'
    ];



    public function cat_status (){

        return $this-> is_active === false  ? "غير مفعل  " : 'مفعل' ;
    }
}
