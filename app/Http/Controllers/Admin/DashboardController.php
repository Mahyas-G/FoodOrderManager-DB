<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersCount = Order::count();
        $paidOrders = Order::where('status','paid')->count();
        $revenue = Payment::where('status','success')->with('order')->get()
            ->sum(fn($p)=>$p->order->total);
        $menusCount = Menu::count();

        return view('admin.dashboard', compact('ordersCount','paidOrders','revenue','menusCount'));
    }
}
