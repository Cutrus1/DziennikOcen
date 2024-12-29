@extends('szablon.szablon')

@section('tytul', 'Dodawanie użytkownika')
@section('podtytul', 'Dodanie nowego użytkownika')
@section('tresc')

@if($errors->any())
    <div class="alert alert-danger">Uzupełnij brakujące pola.</div>
@endif

<form action="{{ route('users.store') }}" method="post" class="w-100">
    @csrf
    <div class="form-group mb-3">
        <label for="name" class="form-label">Imię i nazwisko</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Podaj imię i nazwisko" value="{{ old('name') }}">
        @error('name')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Podaj adres e-mail" value="{{ old('email') }}">
        @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password" class="form-label">Hasło</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Wprowadź hasło">
        @error('password')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password_confirmation" class="form-label">Potwierdź hasło</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Wprowadź hasło ponownie">
        @error('password_confirmation')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="role" class="form-label">Rola użytkownika</label>
        <select class="form-select" name="role" id="role">
            <option value="">Wybierz rolę</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
            <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Nauczyciel</option>
            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Uczeń</option>
        </select>
        @error('role')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary form-btn mt-3">Dodaj użytkownika</button>
</form>

<a href="{{ route('users.index') }}">
    <button type="button" class="btn btn-success form-btn mt-3">Powrót do listy użytkowników</button>
</a>

@endsection