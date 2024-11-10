<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    //
    public function home( Request $request )
	{

        $search = $request->search;
        $posts = Post::where('title', 'LIKE', "%$search%")
        ->with('user')
        ->latest()->paginate();

        return view('home', ['posts' => $posts]);

        //bonus de optimizacion - visualizar en el navegado 
        //baRRA DE DEPURACION app_debub true o false . para las consutlas
        //composer require barryvdh/laravel-debugbar --dev
        
    }

    // public function blog() 
    // {
    // 	// consulta en base de datos
    //     // $posts = [
    //     //     ['id' => 1, 'title' => 'PHP',     'slug' => 'php'],
    //     //     ['id' => 2, 'title' => 'Laravel', 'slug' => 'laravel']
    //     // ];
    //     //eloquent
    //     $posts = Post::latest()->paginate();

    //     return view('blog', ['posts' => $posts]);
    // }

    public function post(Post $post) 
    {
        // consulta en base de datos con el slug
        //$post = $slug;

        return view('post', ['post' => $post]);
    }
}
