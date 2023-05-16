<nav class="navbar navbar-expand-md px-2 shadow-sm">
    <div class="container-md p-3">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto d-flex align-items-start">
                <li class="nav-item">
                    <a class="nav-link" href="/course" style="color: #000;">Cursuri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/exercise" style="color: #000;">Exerciții</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/forums" style="color: #000;">Discuții</a>
                </li>
            </ul>
            <div class="row d-none d-md-block">
            <form class="rounded-pill" action="{{ route('course.index') }}" method="GET">
                <div class="input-group">
                    <div class="form-outline">
                        <input id="form1" type="search" class="form-control border-white rounded-left-1" placeholder="Caută cursuri" name="search" style="min-width: 400px;">
                    </div>
                    <button class="btn  btn-primar bg-white rounded-right-1" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
            <ul class="navbar-nav ms-auto">
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" style="color: #000;">{{ __('Login') }}</a>
                </li>
                @endif
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}" style="color: #000;">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #000;">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/account/{{ Auth::user()->id }}" style="color: #000;">
                            Contul meu
                        </a>
                        <a class="dropdown-item" href="/home" style="color: #000;">
                            Dashboard
                        </a>
                        @if(Auth::user()->isAdmin())
                        <a class="dropdown-item" href="/course/create" style="color: #000;">
                            Adaugă curs
                        </a>
                        <a class="dropdown-item" href="/problem/create" style="color: #000;">
                            Adaugă exercițiu
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" style="color: #000;">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>