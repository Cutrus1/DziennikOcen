@extends('szablon.szablon')
@section('tytul','Edytowanie postu')
@section('podtytul', 'Edycja postu')
@section('tresc')
@isset($post)
<form action="{{route('post.update', $post->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="for-group">
        <label for="tytul">Tytuł</label>
        <input type="text" class="form-control" name="tytul" id="tytul" value="@if(old('tytul') !== null){{old('tytul')}}@else{{$post->tytul}}@endif" >
    </div>
    <div class="for-group">
        <label for="autor">Autor</label>
        <input type="text" class="form-control" name="autor" id="autor" value="@if(old('autor') !== null){{old('autor')}}@else{{$post->autor}}@endif" >
    </div>
    <div class="for-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="@if(old('email') !== null){{old('email')}}@else{{$post->email}}@endif" >
    </div><div class="for-group">
        <label for="tresc">Treść</label>
        <textarea class="form-control" name="tresc" id="tresc" cols="4" >@if(old('tresc') !== null){{old('tresc')}}@else{{$post->tresc}}@endif</textarea>
    </div> 
    <button type="submit" class="btn btn-primary form-btn mt-1">Zapisz zmiany</button>
</form>
@endisset
<a href="{{route('post.index')}}"><button class="btn btn-success form-btn mt-2" type="button">Do listy postów</button></a>

@endsection
