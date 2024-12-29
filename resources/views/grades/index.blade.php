@extends('szablon.szablon')

@section('tytul', 'Oceny')
@section('podtytul', 'Lista ocen')

@section('tresc')
    @if($grades->isEmpty())
        <p class="text-center">Brak ocen do wyświetlenia.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Lp</th>
                    <th>Uczeń</th>
                    <th>Przedmiot</th>
                    <th>Ocena</th>
                    <th>Nauczyciel</th>
                    <th>Data wystawienia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $index => $grade)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $grade->student->name }}</td>
                        <td>{{ $grade->subject }}</td>
                        <td>{{ $grade->grade }}</td>
                        <td>{{ $grade->teacher->name }}</td>
                        <td>{{ $grade->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
