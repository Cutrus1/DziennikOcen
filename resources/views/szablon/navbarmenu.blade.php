<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('start') }}">Start</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('onas') }}">O nas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontakt') }}">Kontakt</a>
                </li>
                
                <!-- Zakładki dostępne dla wszystkich zalogowanych -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Posty
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('post.index') }}">Lista postów</a></li>
                            <li><a class="dropdown-item" href="{{ route('post.create') }}">Dodaj post</a></li>
                        </ul>
                    </li>

                    <!-- Zakładki dynamiczne na podstawie roli -->
                    @if (Auth::user()->role === 'student')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grades.index') }}">Moje oceny</a>
                        </li>
                    @elseif (Auth::user()->role === 'teacher')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grades.index') }}">Oceny</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grades.create') }}">Dodaj ocenę</a>
                        </li>
                    @elseif (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grades.index') }}">Oceny</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grades.create') }}">Dodaj ocenę</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Użytkownicy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('subjects.index') }}">Przedmioty</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
