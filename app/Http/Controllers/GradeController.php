<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Subject;

class GradeController extends Controller
{
    // Widok ocen dla ucznia, nauczyciela lub administratora
    public function index()
    {
        // Jeśli użytkownik jest nauczycielem, pokaż wystawione przez niego oceny
        if (auth()->user()->role === 'teacher') {
            $grades = Grade::where('teacher_id', auth()->id())->get();
        } 
        // Jeśli użytkownik jest uczniem, pokaż jego oceny
        elseif (auth()->user()->role === 'student') {
            $grades = Grade::where('student_id', auth()->id())->get();
        } 
        // Jeśli użytkownik jest administratorem, pokaż wszystkie oceny
        elseif (auth()->user()->role === 'admin') {
            $grades = Grade::all();
        } else {
            abort(403, 'Nieautoryzowany dostęp.');
        }

        return view('grades.index', compact('grades'));
    }

    // Formularz dodawania oceny (dla nauczyciela)
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all(); // Pobranie wszystkich przedmiotów
        return view('grades.create', compact('students', 'subjects'));
    }

    // Zapisanie nowej oceny
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject' => 'required|string',
            'grade' => 'required|string|in:1,2,3,4,5,6',
        ]);
    
        Grade::create([
            'student_id' => $request->student_id,
            'teacher_id' => auth()->id(),
            'subject' => $request->subject,
            'grade' => $request->grade,
        ]);
    
        // Przekierowanie na /grades/create z komunikatem o sukcesie
        return redirect()->route('grades.create')->with('success', 'Ocena została pomyślnie dodana.');
    }

    // Formularz edycji oceny
    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    // Aktualizacja oceny
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'subject' => 'required|string',
            'grade' => 'required|string|in:1,2,3,4,5,6',
        ]);

        $grade->update([
            'subject' => $request->subject,
            'grade' => $request->grade,
        ]);

        return redirect()->route('grades.index')->with('success', 'Ocena została zaktualizowana.');
    }

    // Usunięcie oceny
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Ocena została usunięta.');
    }
}
