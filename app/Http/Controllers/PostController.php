<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10); // Change from all() to paginate(10)
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function create(){
        $users = User::all();
        return view('posts.create', ['users'=> $users]);
    }
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
    
        // Create post data array
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['post_creator'],
        ];
    
        // Add image if provided
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }
    
        // Create the post
        $post = Post::create($data);
    
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['post_creator'],
        ];
        
        // Add image if provided
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }
        
        $post->update($data);
        
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Image will be deleted via the boot method in the Post model
        $post->delete();
        
        return to_route('posts.index');
    }
    public function edit(Post $post)
    {
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }

        $users = User::all();

        return view('update', ['post' => $post, 'users' => $users]);
    }
}
