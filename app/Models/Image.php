<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','photo'];




    public function product (){
        return $this->belongsTo(self::class, 'product_id');
    }
}
