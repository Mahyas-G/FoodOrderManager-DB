<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model {
    protected $fillable = ['code','type','value','starts_at','ends_at','usage_limit','used'];
    protected $casts = ['starts_at'=>'datetime','ends_at'=>'datetime'];
}
