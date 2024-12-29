<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dziennik Ocen</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('start') }}">Start</a>
            @auth
                @if (auth()->user()->role === 'student')
                    <a href="{{ route('grades.index') }}">Oceny</a>
                @elseif (auth()->user()->role === 'teacher')
                    <a href="{{ route('grades.create') }}">Dodaj ocenę</a>
                @elseif (auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}">Zarządzaj użytkownikami</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Wyloguj</button>
                </form>
            @endauth
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
