<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posty = Post::all();
        //dd($posty);
        return view('post.lista', compact('posty'));
        
        //return view('post.lista', ['posty', $posty]);
        //return view('post.lista')->with('posty',$posty);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.dodaj');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $post= new Post();
/*         $post->tytul = $request['tytul'];
        $post->autor = request('autor');
        $post->email = request('email');
        $post->tresc = request('tresc');
        $post->save(); */
        $post->create($request->all());
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //dd($post);
        return view('post.pokaz', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edytuj',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //dd($request,$post);
/*         $post->tytul = $request['tytul'];
        $post->autor = request('autor');
        $post->email = request('email');
        $post->tresc = request('tresc');
        $post->save(); */
        $post->update($request->all());
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
