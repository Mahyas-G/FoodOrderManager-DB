<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function home() {
        $popular = Menu::withAvg('ratings','stars')->orderByDesc('ratings_avg_stars')->take(6)->get();
        return view('home', compact('popular'));
    }

    public function index(Request $request) {
        $q = Menu::query()->with('category');

        if ($request->filled('category')) {
            $q->where('category_id', $request->category);
        }
        if ($request->filled('search')) {
            $q->where('name','like','%'.$request->search.'%');
        }
        $menus = $q->paginate(12);
        $categories = Category::orderBy('name')->get();

        return view('menu.index', compact('menus','categories'));
    }

    public function show(Menu $menu) {
        $menu->load(['category','comments.user','ratings']);
        $avgRating = (int) round($menu->ratings()->avg('stars'));
        return view('menu.show', compact('menu','avgRating'));
    }
}
