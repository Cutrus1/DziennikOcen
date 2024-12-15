@extends('szablon.szablon')
@section('tytul','Edytowanie postu')
@section('podtytul', 'Edycja postu')
@section('tresc')
@isset($post)
@if($errors->any())
<div class="alert alert-danger">Uzupełnij brakujące pola</div>
@endif
<form action="{{route('post.update', $post->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="for-group">
        <label for="tytul">Tytuł</label>
        <input type="text" class="form-control" name="tytul" id="tytul" value="@if(old('tytul') !== null){{old('tytul')}}@else{{$post->tytul}}@endif" >
        @error('tytul')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="for-group">
        <label for="tresc">Treść</label>
        <textarea class="form-control" name="tresc" id="tresc" cols="4" >@if(old('tresc') !== null){{old('tresc')}}@else{{$post->tresc}}@endif</textarea>
        @error('tresc')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div> 
    <button type="submit" class="btn btn-primary form-btn mt-1">Zapisz zmiany</button>
</form>
@endisset
<a href="{{route('post.index')}}"><button class="btn btn-success form-btn mt-2" type="button">Do listy postów</button></a>

@endsection
