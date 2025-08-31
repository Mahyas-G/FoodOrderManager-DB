<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function apply(Request $request) {
        $request->validate(['code'=>'required|string']);
        $code = strtoupper(trim($request->code));
        $discount = Discount::where('code',$code)->first();

        if (!$discount) return back()->withErrors(['code'=>'کد معتبر نیست']);

        $now = Carbon::now();
        if (($discount->starts_at && $discount->starts_at->isFuture()) ||
            ($discount->ends_at && $discount->ends_at->isPast())) {
            return back()->withErrors(['code'=>'زمان استفاده از کد معتبر نیست']);
        }
        if ($discount->usage_limit && $discount->used >= $discount->usage_limit) {
            return back()->withErrors(['code'=>'سقف استفاده از کد تکمیل شده']);
        }

        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($i)=>$i['qty']*$i['price']);
        if ($subtotal <= 0) return back()->withErrors(['code'=>'سبد خالی است']);

        $amount = $discount->type === 'percent'
            ? intdiv($subtotal * $discount->value, 100)
            : min($discount->value, $subtotal);

        session()->put('discount', ['code'=>$code,'amount'=>$amount]);
        return back()->with('ok','کد تخفیف اعمال شد');
    }
}
