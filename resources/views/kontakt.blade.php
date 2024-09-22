@extends('szablon')
@section('tytul')
    Kontakt
@endsection

@section('podtytul')
    Strona kontaktowa
@endsection

@section('tresc')
    <p>Przykładowa treść dla kontaktu</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum omnis suscipit error dignissimos, laudantium doloribus dolorum. Laboriosam illo nihil tempora sunt, voluptatem a labore tempore temporibus esse fuga voluptatibus voluptate?</p>
 
    <ol>
    @foreach ($zadania as $zadanie)
        <li>{{ $zadanie }} </li>
    @endforeach
   </ol>
@endsection