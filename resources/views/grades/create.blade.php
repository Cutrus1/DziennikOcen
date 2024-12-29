@extends('szablon.szablon')

@section('tytul', 'Dodawanie oceny')
@section('podtytul', 'Formularz dodawania nowej oceny')

@section('tresc')
@if($errors->any())
    <div class="alert alert-danger">Uzupełnij brakujące pola.</div>
@endif

<form action="{{ route('grades.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="student_id">Uczeń</label>
        <select name="student_id" id="student_id" class="form-control" required>
            <option value="">Wybierz ucznia</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="subject">Przedmiot</label>
        <select name="subject" id="subject" class="form-control" required>
            <option value="">Wybierz przedmiot</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->name }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="grade">Ocena</label>
        <select name="grade" id="grade" class="form-control" required>
            <option value="">Wybierz ocenę</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Dodaj ocenę</button>
</form>
@endsection
