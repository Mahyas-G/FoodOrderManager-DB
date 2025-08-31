<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['user_id','subtotal','discount_amount','total','status','discount_code'];
    public function items(){ return $this->hasMany(OrderItem::class); }
    public function payment(){ return $this->hasOne(Payment::class); }
    public function user(){ return $this->belongsTo(User::class); }
}

