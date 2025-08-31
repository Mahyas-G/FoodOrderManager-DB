<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function cart() {
        return session()->get('cart', []);
    }
    private function saveCart($cart) {
        session()->put('cart', $cart);
    }

    public function add(Request $request, Menu $menu) {
        $validated = $request->validate(['quantity' => 'required|integer|min:1']);
        $cart = $this->cart();

        $item = $cart[$menu->id] ?? ['name'=>$menu->name,'qty'=>0,'price'=>$menu->price];
        $item['qty'] += $validated['quantity'];
        $cart[$menu->id] = $item;

        $this->saveCart($cart);
        return redirect()->route('cart.show')->with('ok','به سبد اضافه شد');
    }

    public function show() {
        $cart = $this->cart();
        $subtotal = collect($cart)->sum(fn($i)=>$i['qty']*$i['price']);
        $discount = session('discount', ['code'=>null,'amount'=>0]);
        $total = max(0, $subtotal - $discount['amount']);
        return view('cart.show', compact('cart','subtotal','discount','total'));
    }

    public function remove(Menu $menu) {
        $cart = $this->cart();
        unset($cart[$menu->id]);
        $this->saveCart($cart);
        return back()->with('ok','آیتم حذف شد');
    }

    public function clear() {
        session()->forget(['cart','discount']);
        return back()->with('ok','سبد خالی شد');
    }
}
