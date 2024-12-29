@extends('szablon.szablon')
@section('tytul', 'Lista przedmiotów')
@section('tresc')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h2>Lista przedmiotów</h2>

<a href="{{ route('subjects.create') }}" class="btn btn-primary">Dodaj przedmiot</a>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>
                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Czy na pewno usunąć przedmiot?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Usuń</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
