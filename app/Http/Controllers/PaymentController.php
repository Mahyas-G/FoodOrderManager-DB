<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        if (!$order->payment) {
            $payment = Payment::create([
                'order_id' => $order->id,
                'gateway' => 'mock',
                'status' => 'initiated',
            ]);
            PaymentHistory::create([
                'payment_id' => $payment->id,
                'event' => 'created',
                'payload' => ['order'=>$order->id],
            ]);
        }
        return view('payment.create', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $payment = $order->payment;
        $payment->update([
            'status' => 'success',
            'transaction_ref' => Str::uuid()->toString(),
        ]);
        PaymentHistory::create([
            'payment_id' => $payment->id,
            'event' => 'callback',
            'payload' => ['status'=>'success'],
        ]);

        $order->update(['status' => 'paid']);

        session()->forget(['cart','discount']);

        return redirect()->route('payment.result', ['status'=>'success','order'=>$order->id]);
    }

    public function result(string $status, Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        return view('payment.result', compact('status','order'));
    }
}
