@extends('szablon.szablon')
@section('tytul', 'Kontakt')
@section('podtytul', 'Strona kontaktowa')
@section('tresc')
    <p>Kontakt</p>
    <p>Masz pytania lub sugestie? Skontaktuj się z nami! Jesteśmy tu, aby pomóc i odpowiedzieć na wszystkie Twoje wątpliwości dotyczące aplikacji DziennikOcen.</p>
    @isset($zadania)
    <ol>
    @foreach ($zadania as $zadanie)
        <li>{{ $zadanie }} </li>
    @endforeach
   </ol>   
   <div style="font-family: Arial, sans-serif; max-width: 400px; margin: 20px auto; padding: 20px; border: 1px solid #d30f0f; border-radius: 8px; box-shadow: 0 4px 6px rgba(14, 6, 6, 0.1); background-color: #f9f9f9;">
    <h2 style="text-align: center; color: #333;">Zapraszamy do kontaktu</h2>
    <ul style="list-style-type: none; padding: 0;">
        <li style="margin-bottom: 10px;">
            <strong>Email:</strong> 
            <a href="mailto:kontakt@dziennikocen.pl" style="text-decoration: none; color: #007BFF;">kontakt@dziennikocen.pl</a>
        </li>
        <li style="margin-bottom: 10px;">
            <strong>Telefon:</strong> 
            <a href="tel:+48123456789" style="text-decoration: none; color: #007BFF;">+48 123 456 789</a>
        </li>
        <li>
            <strong>Adres:</strong> 
            <span style="color: #555;">ul. Rynek 21, 00-001 Poznań</span>
        </li>
    </ul>
</div>

    @endisset
    
@endsection