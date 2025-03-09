<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 1, 
                'title' => 'laravel', 
                'description' => 'Laravel is a powerful PHP framework for web development',
                'posted_by' => 'ahmed', 
                'created_at' => '2025-03-08 12:47:00'
            ],
            [
                'id' => 2, 
                'title' => 'HTML', 
                'description' => 'HTML is the standard markup language for creating web pages',
                'posted_by' => 'mohamed', 
                'created_at' => '2025-04-10 11:00:00'
            ],
            [
                'id' => 3, 
                'title' => 'CSS', 
                'description' => 'CSS is the language used to style web pages',
                'posted_by' => 'sara', 
                'created_at' => '2025-04-15 09:30:00'
            ],
        ];

        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = [
            'id' => 1,
            'title' => 'laravel',
            'description' => 'laravel is a php framework',
            'posted_by' => [
                'name' => 'ahmed',
                'email' => 'test@gmail.com',
                'created_at' => '2025-03-08 12:47:00'
            ],
            'created_at' => '2025-03-08 12:47:00'
        ];

        return view('posts.show', ['post' => $post]);
    }
    public function create(){
        return view('posts.create');
    }
    public function store(){
        // $data = request()->all();
        // $title = $data['title'];
        // $description = $data['description'];
        $title = request()->title;
        $description = request()->description;
        // dd($title, $description);
        return to_route('posts.show', 1);
        

    }
    public function edit($id){
        $post= null;
        $posts = [
            [
                'id' => 1, 
                'title' => 'laravel', 
                'description' => 'Laravel is a powerful PHP framework for web development',
                'posted_by' => 'ahmed', 
                'created_at' => '2025-03-08 12:47:00'
            ],
            [
                'id' => 2, 
                'title' => 'HTML', 
                'description' => 'HTML is the standard markup language for creating web pages',
                'posted_by' => 'mohamed', 
                'created_at' => '2025-04-10 11:00:00'
            ],
            [
                'id' => 3, 
                'title' => 'CSS', 
                'description' => 'CSS is the language used to style web pages',
                'posted_by' => 'sara', 
                'created_at' => '2025-04-15 09:30:00'
            ],
        ];
        foreach ($posts as $p) {
            if ($p['id'] == $id) {
                $post = $p;
                break;
            }
        }
        // return $post;
        return view('update',['post'=>$post]);
    }
    public function update(){
        return to_route('posts.index');


        // return to_route('posts.index');
    }
    public function destroy($id)
    {
        // For now, we'll just redirect back with a success message
        // Later you can add actual database deletion logic
        return to_route('posts.index');
    }
}
