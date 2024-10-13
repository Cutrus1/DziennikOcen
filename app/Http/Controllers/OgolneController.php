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
        $zadania = [
        'Zadanie 1',
        'Zadanie 2',
        'Zadanie 3'
    ];
    return view('ogolne.kontakt', ['zadania' => $zadania]);
    }
}
