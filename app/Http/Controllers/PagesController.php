<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    protected  $namespace =  'App\\Http\\Controllers'; // 添加这一行
    public function root()
    {
        return view('pages.root');
    }
}
