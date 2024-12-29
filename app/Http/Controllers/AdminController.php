<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Wyświetlenie listy użytkowników
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Formularz do tworzenia nowego użytkownika
    public function create()
    {
        return view('admin.users.create');
    }

    // Zapisanie nowego użytkownika
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:admin,teacher,student',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    
        return redirect()->route('users.index')->with('success', 'Użytkownik został pomyślnie dodany.');
    }

    // Formularz do edycji użytkownika
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Aktualizacja użytkownika
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'role' => 'required|in:admin,teacher,student',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // Zaktualizuj hasło tylko, jeśli zostało podane
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);
    
        return redirect()->route('users.index')->with('success', 'Użytkownik został pomyślnie zaktualizowany.');
    }

    // Usunięcie użytkownika
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Użytkownik został usunięty.');
    }
}