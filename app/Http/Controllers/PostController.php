<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posty = Post::paginate(10);
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
    //public function store(Request $request)
    public function store(PostStoreRequest $request)
    {
        //return $request;
        $post= new Post();
/*         $post->tytul = $request['tytul'];
        $post->autor = request('autor');
        $post->email = request('email');
        $post->tresc = request('tresc');
        $post->save(); */
       /*  $request->validate([
            'tytul' => 'required|min:3|max:200',
            'autor' => ['required', 'min:4', 'max:100'],
            'email' => ['required', 'email:rfc,dns'],
            'tresc' => ['required', 'min:5']
        ]); */
        $request->merge(['user_id' => Auth::user()->id]);
        //$post->user_id = Auth::user()->id; //to nie działa
        $post->create($request->all());
        return redirect()->route('post.index')->with('message',"Dodano poprawnie post");
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
    public function update(PostStoreRequest $request, Post $post)
    {
        //dd($request,$post);
/*         $post->tytul = $request['tytul'];
        $post->autor = request('autor');
        $post->email = request('email');
        $post->tresc = request('tresc');
        $post->save(); */
        //$request->merge(['user_id' => Auth::user()->id]); //to działa
        $post->user_id = Auth::user()->id;
        $post->update($request->all());
        return redirect()->route('post.index')->with('message',"Zmieniono poprawnie post");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message',"Usunieto poprawnie post")->with('class', 'danger');
    }
}
