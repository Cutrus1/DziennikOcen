@extends('szablon.szablon')
@section('tytul', 'Dodaj przedmiot')
@section('tresc')

<h2>Dodaj nowy przedmiot</h2>

@if($errors->any())
    <div class="alert alert-danger">Uzupełnij brakujące pola</div>
@endif

<form action="{{ route('subjects.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nazwa przedmiotu</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Podaj nazwę przedmiotu" value="{{ old('name') }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Dodaj przedmiot</button>
</form>

@endsection
