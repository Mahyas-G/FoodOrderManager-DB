<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create(Menu $menu)
    {
        if ($menu->ratings()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('menu.show', $menu)->with('error', 'شما قبلاً به این غذا امتیاز داده‌اید.');
        }

        return view('ratings.create', compact('menu'));
    }

    public function store(Request $request, Menu $menu)
    {
        $request->validate(['stars' => 'required|integer|min:1|max:5']);

        if ($menu->ratings()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('menu.show', $menu)->with('error', 'شما قبلاً به این غذا امتیاز داده‌اید.');
        }

        $menu->ratings()->create([
            'user_id' => auth()->id(),
            'stars' => $request->stars
        ]);

        return redirect()->route('menu.show', $menu)->with('success', 'امتیاز شما ثبت شد.');
    }
}
