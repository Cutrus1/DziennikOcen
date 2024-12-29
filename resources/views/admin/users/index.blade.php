@extends('szablon.szablon')
@section('tytul', 'Zarządzanie użytkownikami')
@section('podtytul', 'Lista użytkowników')
@section('tresc')
<a href="{{ route('users.create') }}"><button class="btn btn-primary form-btn mb-3">Dodaj użytkownika</button></a>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Lp</th>
            <th scope="col">Imię</th>
            <th scope="col">Email</th>
            <th scope="col">Rola</th>
            <th scope="col">Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success form-btn">Edytuj</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger form-btn" onclick="return confirm('Czy na pewno usunąć tego użytkownika?')">Usuń</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
