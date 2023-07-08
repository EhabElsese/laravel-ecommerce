<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerfication extends Model
{
    use HasFactory;

    public $table = "users_verficationcodes";


    protected $fillable = ['user_id','code','created_at','updated_at'];




}
