@extends('szablon.szablon')
@section('tytul', 'Edytowanie oceny')
@section('podtytul', 'Edycja oceny')
@section('tresc')
@if($errors->any())
    <div class="alert alert-danger">Uzupełnij brakujące pola</div>
@endif
<form action="{{ route('grades.update', $grade->id) }}" method="post" class="w-100">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="subject">Przedmiot</label>
        <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject', $grade->subject) }}">
        @error('subject')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="grade">Ocena</label>
        <input type="text" class="form-control" name="grade" id="grade" value="{{ old('grade', $grade->grade) }}">
        @error('grade')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary form-btn mt-3">Zapisz zmiany</button>
</form>
<a href="{{ route('grades.index') }}"><button type="button" class="btn btn-success form-btn mt-2">Powrót do listy ocen</button></a>
@endsection
