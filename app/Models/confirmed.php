<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class confirmed extends Model
{
    use HasFactory;
    protected $fillable = ['user_name','total_price','order_code'];
}
