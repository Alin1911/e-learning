<nav class="navbar navbar-expand-md px-2 shadow-sm">
    <div class="container-md px-1 py-3 d-flex justify-content-center justify-content-md-start">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler border-0 navbar-toggler-focus mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#search"
            aria-controls="search" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-search text-white"></i>
        </button>
        <button class="navbar-toggler border-0 navbar-toggler-focus" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars text-white"></i>
        </button>
        <div class="row collapse w-100 mt-4" id="search">
            <form class="form-control rounded-pill col-12 py-3" action="{{ route('course.index') }}" method="GET">
                <input
                    id="form1"
                    type="search"
                    class="form-control rounded-pill border-white"
                    placeholder="Caută cursuri"
                    name="search"
                    @if(isset($search)) value="{{ $search }}" @endif
                >
                <hr class="m-0">
                <button class="btn bg-light w-100 rounded-pill" type="submit" aria-label="Trimite formularul"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="collapse navbar-collapse p-1" id="navbarSupportedContent">
            <div class="navbar-nav me-auto d-flex align-items-center px-3">
                <div class="nav-item">
                    <a class="nav-link" href="/course" style="color: #000;">Cursuri</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/problem" style="color: #000;">Exerciții</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/forums" style="color: #000;">Discuții</a>
                </div>
            </div>
            <div class="w-100 d-flex justify-content-center d-none d-md-flex">
                <div class="d-flex">
                    <form class="input-group rounded-pill" action="{{ route('course.index') }}" method="GET">
                        <input 
                            id="form2"
                            type="search"
                            class="form-control border-white rounded-left-1"
                            placeholder="Caută cursuri"
                            name="search"
                            @if(isset($search)) value="{{ $search }}" @endif
                            style="min-width: 400px;"
                        >
                        <button class="btn bg-white rounded-right-1" type="submit" aria-label="Trimite formularul"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            @if(Auth::check())
                <div class="dropdown show">
                    <a class="text-uppercase text-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/home" style="color: #000;">Activitățile mele</a>
                        <a class="dropdown-item" href="/account/1/edit" style="color: #000;">Contul meu</a>
                        @if(Auth::user()->isAdmin() || Auth::user()->isTeacher())
                            <a class="dropdown-item" href="/course/create" style="color: #000;">Cursuri</a>
                            <a class="dropdown-item" href="/problem/create" style="color: #000;">Probleme</a>
                        @else 
                            <a class="dropdown-item" href="/role/request/create" style="color: #000;">Cerere rol</a>
                        @endif
                        @if(Auth::user()->isAdmin())
                            <a class="dropdown-item" href="/role/request" style="color: #000;">Cereri rol</a>
                        @endif
                        @if(Auth::user()->isTeacher())
                            <a class="dropdown-item" href="/role/request/create" style="color: #000;">Cerere rol</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="color: #000;">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a class="btn btn-white d-md-none" href="{{ route('login') }}">
                    <i class="fa-solid fa-user text-white"></i>
                </a>
            @endif
        </div>
        @if(!Auth::check())
            <div class="navbar-nav ms-auto d-flex align-items-center px-3">
                @if (Route::has('login'))
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color: #000;">{{ __('Login') }}</a>
                    </div>
                @endif
                @if (Route::has('register'))
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" style="color: #000;">{{ __('Register') }}</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</nav>
