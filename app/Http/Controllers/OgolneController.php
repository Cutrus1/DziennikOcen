<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OgolneController extends Controller
{
    public function start()
    {
        return view('ogolne.welcome');
    }

    public function onas()
    {
        return view('ogolne.onas');
    }

    public function kontakt()
    {
        $zadania = ['1. Odpowiadanie na zgłoszenia techniczne i wsparcie użytkowników.', '2. Rozwój aplikacji i wprowadzanie nowych funkcji, zgodnie z potrzebami użytkowników.', '3. Dbałość o bezpieczeństwo i przejrzystość danych w systemie.'];
        return view('ogolne.kontakt', compact('zadania'));
    }
}
