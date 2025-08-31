<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function orders() {
        $orders = Order::with('user')->latest()->paginate(30);
        return view('admin.reports.orders', compact('orders'));
    }

    public function popular() {
        $popular = OrderItem::select('menu_id', DB::raw('SUM(quantity) as qty'))
            ->groupBy('menu_id')->orderByDesc('qty')->with('menu')->paginate(30);
        return view('admin.reports.popular', compact('popular'));
    }

    public function payments() {
        $payments = Payment::with('order.user')->latest()->paginate(30);
        return view('admin.reports.payments', compact('payments'));
    }
}
