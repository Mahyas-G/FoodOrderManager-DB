<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = session('cart', []);
        abort_if(empty($cart), 400, 'Cart is empty');

        $subtotal = collect($cart)->sum(fn($i)=>$i['qty']*$i['price']);
        $discount = session('discount', ['code'=>null,'amount'=>0]);
        $total = max(0, $subtotal - $discount['amount']);

        $order = DB::transaction(function () use ($cart, $subtotal, $discount, $total, $request) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'subtotal' => $subtotal,
                'discount_amount' => $discount['amount'],
                'total' => $total,
                'status' => 'pending',
                'discount_code' => $discount['code'],
            ]);

            foreach ($cart as $menuId => $item) {
                $menu = Menu::findOrFail($menuId);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['qty'],
                    'unit_price' => $menu->price,
                    'line_total' => $menu->price * $item['qty'],
                ]);
                $menu->decrement('stock', $item['qty']);
            }
            return $order;
        });

        return redirect()->route('payment.create', $order)->with('ok','سفارش ثبت شد، ادامه‌ی پرداخت');
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->load('items.menu','payment');
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

}
