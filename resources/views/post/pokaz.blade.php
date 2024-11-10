@extends('szablon.szablon')
@section('tytul','Dodawaniu postu')
@section('podtytul', 'Dodanie postu')
@section('tresc')
@isset($post)
    <div class="for-group">
        <label for="tytul">Tytuł</label>
        <input type="text" class="form-control" name="tytul" id="tytul"  value="{{$post->tytul}}" disabled>
    </div>
    <div class="for-group">
        <label for="autor">Autor</label>
        <input type="text" class="form-control" name="autor" id="autor" value="{{$post->autor}}" disabled>
    </div>
    <div class="for-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{$post->email}}" disabled>
    </div><div class="for-group">
        <label for="tresc">Treść</label>
        <textarea class="form-control" name="tresc" id="tresc" cols="4" disabled>{{$post->tresc}}</textarea>
    </div> 
    <div class="form-control">
        Data utworzenia:{{$post->created_at}}
        </div>  
        <div class="form-control">
        Data edycji:{{$post->updated_at}}
        </div>  
@endisset
<a href="{{route('post.index')}}"><button class="btn btn-success form-btn mt-2" type="button">Do listy postów</button></a>
@endsection