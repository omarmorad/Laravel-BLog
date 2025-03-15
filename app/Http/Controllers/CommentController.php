<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('posts.show', $post->slug);
    }
}