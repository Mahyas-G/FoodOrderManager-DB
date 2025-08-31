<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Menu;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Menu $menu)
    {
        $validated = $request->validate(['body'=>'required|string|min:3']);
        Comment::create([
            'user_id' => $request->user()->id,
            'menu_id' => $menu->id,
            'body' => $validated['body'],
        ]);
        return back()->with('ok','نظر شما ثبت شد');
    }

}
