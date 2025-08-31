<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuAdminController extends Controller
{
    public function index() {
        $menus = Menu::with('category')->latest()->paginate(20);
        return view('admin.menus.index', compact('menus'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|integer|min:0',
            'stock'=>'required|integer|min:0',
            'description'=>'nullable|string',
            'image'=>'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('', 'private'); // storage/app/private/data/xxxxx
            $validated['image_path'] = $path;
        }

        Menu::create($validated);
        return redirect()->route('admin.menus.index')->with('ok','غذا ثبت شد');
    }

    public function edit(Menu $menu) {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));
    }

    public function update(Request $request, Menu $menu) {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|integer|min:0',
            'stock'=>'required|integer|min:0',
            'description'=>'nullable|string',
            'image'=>'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image_path) Storage::disk('private')->delete($menu->image_path);
            $validated['image_path'] = $request->file('image')->store('', 'private');
        }

        $menu->update($validated);
        return redirect()->route('admin.menus.index')->with('ok','به‌روزرسانی شد');
    }

    public function destroy(Menu $menu) {
        if ($menu->image_path) Storage::disk('private')->delete($menu->image_path);
        $menu->delete();
        return back()->with('ok','حذف شد');
    }

    public function show(Menu $menu) {
        return redirect()->route('admin.menus.edit', $menu);
    }
}
