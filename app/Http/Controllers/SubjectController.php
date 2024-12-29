<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Wyświetlanie listy przedmiotów
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    // Formularz dodawania przedmiotu
    public function create()
    {
        return view('subjects.create');
    }

    // Zapis nowego przedmiotu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:subjects,name|max:255',
        ]);

        Subject::create([
            'name' => $request->name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Przedmiot został dodany.');
    }

    // Usuwanie przedmiotu
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Przedmiot został usunięty.');
    }
}
