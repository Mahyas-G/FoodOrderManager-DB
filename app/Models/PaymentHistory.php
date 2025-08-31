<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model {
    protected $table = 'payment_history';
    protected $fillable = ['payment_id','event','payload'];
    protected $casts = ['payload' => 'array'];
    public function payment(){ return $this->belongsTo(Payment::class); }
}
