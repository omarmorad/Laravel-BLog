<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|min:3',
            'user_id' => 'required|exists:users,id'
        ]);

        $post = Post::findOrFail($postId);
        
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        
        $post->comments()->save($comment);
        
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}