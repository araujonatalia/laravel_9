<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{
    public function index() 
    {
        $curret_user = auth()->user()->id;
        
        return view('posts.index', [
						// Esto filtra los resultados por id
            'posts' => Post::where('user_id', '=',$curret_user)->latest('id')->paginate()
        ]);
       // return view('posts.index', ['posts' => Post::latest()->paginate()]);
    }


    /**
     * Show the form for creating a new post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
        
    public function create(Post $post) 
    {

        return view('posts.create', ['post' => $post]);
    }

    public function store(Request $request) 
    {

        $request->validate([
    		'title' => 'required',
            'slug'  => 'required|unique:posts,slug',
    		'body'  => 'required'
    	],[
            'title.required'=>'Este campo es requerido',
            'slug.required'=>'Colocar la url',
            'slug.unique'=>'La Url debe ser única',
            'body.required'=>'Se necesita mínimo un párrafo',
        ]);

        $post = $request->user()->posts()->create([
            // 'title' => $title = $request->title,
            // 'slug'  => Str::slug($title),
            'title' => $request->title,
            'slug'  => $request->slug,
            'body'  => $request->body,
        ]);

        return redirect()->route('posts.index', $post);
    }

    public function edit(Post $post) 
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
    		'title' => 'required',
            'slug'  => 'required|unique:posts,slug,' . $post->id,
    		'body'  => 'required'
    	]);

        $post->update([
            'title' => $request->title,
            'slug'  => $request->slug,
            'body'  => $request->body,
        ]);

        return redirect()->route('posts.index', $post);
    }

    public function destroy(Post $post) 
    {
        $post->delete();

        return redirect()->route('posts.index');
       // return back();
    }

}
