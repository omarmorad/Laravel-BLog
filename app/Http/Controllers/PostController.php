<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10); // Change from all() to paginate(10)
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::with('user')->find($id);

        return view('posts.show', ['post' => $post]);
    }
    public function create(){
        $users = User::all();
        return view('posts.create', ['users'=> $users]);
    }
    public function store(){
        // $data = request()->all();
        // $title = $data['title'];
        // $description = $data['description'];
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        //  dd($title, $description , $postCreator);
        $post = Post::create([
            'title'=> $title,
            'description'=> $description,
            'user_id'=> $postCreator,
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);
        return to_route('posts.show', $post->id);
        

    }
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            // Handle the case where the post is not found
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }

        $users = User::all(); // Fetch all users

        return view('update', ['post' => $post, 'users' => $users]);
    }
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
        ]);
        
        return to_route('posts.index');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return to_route('posts.index');
    }
}
