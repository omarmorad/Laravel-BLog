<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
    
        $posts = Post::all();

        return  PostResource::collection($posts);
    }
    
    public function show($id){
        $post = Post::findOrFail($id);
        
        return new PostResource($post);
    }

    /**
     * Store a newly created post in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest  $request){
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);
        return new PostResource($post);
    }
}
