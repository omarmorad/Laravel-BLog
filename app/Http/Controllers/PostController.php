<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'laravel', 'posted_by' => 'ahmed', 'created_at' => '2025-03-08 12:47:00'],
            ['id' => 2, 'title' => 'HTML', 'posted_by' => 'mohamed', 'created_at' => '2025-04-10 11:00:00'],
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
}
