<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
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
    public function store(StorePostRequest $request){
        // $data = request()->all();
        // $title = $data['title'];
        // $description = $data['description'];

        //1St Syntax of Validation
    //     request()->validate([
    //         'title' => ['required','min:3'],
    //         'description' => ['required','min:10'],
    //     ],
    //     [
    //         'title.required' => 'Title is required',
    //         'title.min' => 'Title must be at least 3 characters',
    //         'description.required' => 'Description is required',
    //         'description.min' => 'Description must be at least 10 characters',
    //     ]
    // );
        $request->validate([
            'title' => ['required','min:3'],
            'description' => ['required','min:10'],
        ]);
     
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
    public function update(StorePostRequest $request, $id)
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
