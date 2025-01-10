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
                    <th>Oceny</th>
                    <th>Średnia z przedmiotu</th>
                    <th>Nauczyciel</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $studentSubjects = [];
                    $colors = [
                        1 => 'red', 
                        2 => 'blue', 
                        3 => 'purple', 
                        4 => 'orange', 
                        5 => 'pink', 
                        6 => 'green', 
                    ];
                @endphp

                <!-- Grupowanie ocen -->
                @foreach ($grades as $grade)
                    @php
                        $studentSubjects[$grade->student->name][$grade->subject]['grades'][] = $grade->grade;
                        $studentSubjects[$grade->student->name][$grade->subject]['teacher'] = $grade->teacher->name;
                    @endphp
                @endforeach

                @php $lp = 1; @endphp
                <!-- Wyświetlanie danych -->
                @foreach ($studentSubjects as $studentName => $subjects)
                    @php
                        $allGrades = [];
                        $subjectAverages = [];
                    @endphp
                    @foreach ($subjects as $subject => $details)
                        @php
                            // Obliczanie średniej z danego przedmiotu
                            $subjectAverage = array_sum($details['grades']) / count($details['grades']);
                            $subjectAverages[] = $subjectAverage;
                            $allGrades = array_merge($allGrades, $details['grades']);
                        @endphp
                        <tr>
                            <td>{{ $lp++ }}</td>
                            <td>{{ $studentName }}</td>
                            <td>{{ $subject }}</td>
                            <td>
                                @foreach ($details['grades'] as $grade)
                                    @php
                                        $color = $colors[$grade] ?? 'black';
                                    @endphp
                                    <span style="
                                        display: inline-block;
                                        width: 30px;
                                        height: 30px;
                                        text-align: center;
                                        line-height: 30px;
                                        border-radius: 5px;
                                        font-weight: bold;
                                        margin: 2px;
                                        color: white;
                                        background-color: {{ $color }};
                                    ">
                                        {{ $grade }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                {{ number_format($subjectAverage, 2) }}
                            </td>
                            <td>{{ $details['teacher'] }}</td>
                        </tr>
                    @endforeach

                    <!-- Wyświetlanie średniej z wszystkich przedmiotów w osobnym wierszu -->
                    <tr>
                        <td colspan="6" class="text-center font-weight-bold bg-light">
                            Średnia z wszystkich przedmiotów: 
                            {{ number_format(array_sum($subjectAverages) / count($subjectAverages), 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
