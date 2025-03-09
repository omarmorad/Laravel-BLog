<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function someAction(){
        $localName = 'ahmed';
        $age = 40;
        return view('test', ['name' => $localName,
        'age'=> $age
    
    
    ]);
    }
}
