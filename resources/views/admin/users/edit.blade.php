@extends('szablon.szablon')

@section('tytul', 'Edycja użytkownika')
@section('podtytul', 'Edycja danych użytkownika')
@section('tresc')

@if($errors->any())
    <div class="alert alert-danger">Uzupełnij brakujące pola.</div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST" class="w-100">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="name" class="form-label">Imię i nazwisko</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
        @error('name')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
        @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="role" class="form-label">Rola użytkownika</label>
        <select class="form-select" name="role" id="role" required>
            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Uczeń</option>
            <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Nauczyciel</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
        </select>
        @error('role')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password" class="form-label">Nowe hasło (opcjonalnie)</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Wprowadź nowe hasło">
        @error('password')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password_confirmation" class="form-label">Potwierdź nowe hasło</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Potwierdź nowe hasło">
    </div>

    <button type="submit" class="btn btn-primary form-btn mt-3">Zapisz zmiany</button>
</form>

<a href="{{ route('users.index') }}">
    <button type="button" class="btn btn-success form-btn mt-3">Powrót do listy użytkowników</button>
</a>

@endsection
