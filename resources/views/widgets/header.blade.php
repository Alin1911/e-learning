<nav class="navbar navbar-expand-md px-2 shadow-sm">
    <div class="container-md p-3">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler border-0 navbar-toggler-focus" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse p-1" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto d-flex align-items-start">
                <li class="my-3 w-100 d-block d-md-none">
                    <form class="row rounded" action="{{ route('course.index') }}" method="GET">
                        <input 
                            id="form1"
                            type="search"
                            class="form-control border-white rounded-0 rounded-top"
                            placeholder="Caută cursuri"
                            name="search"
                            @if(isset($search)) value="{{ $search }}" @endif
                            style="min-width: 400px;">
                        <button class="btn bg-white rounded-right-1" type="submit" aria-label="Trimite formularul"><i class="fas fa-search"></i></button>
                    </form>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/course" style="color: #000;">Cursuri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/problem" style="color: #000;">Exerciții</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/forums" style="color: #000;">Discuții</a>
                </li>
            </ul>
            <div class="row w-100 d-flex justify-content-center d-none d-md-flex">
                <div class="col-auto d-flex">
                    <form class="input-group rounded-pill" action="{{ route('course.index') }}" method="GET">
                        <input 
                            id="form2"
                            type="search"
                            class="form-control border-white rounded-left-1"
                            placeholder="Caută cursuri"
                            name="search"
                            @if(isset($search)) value="{{ $search }}" @endif
                            style="min-width: 400px;">
                        <button class="btn bg-white rounded-right-1" type="submit" aria-label="Trimite formularul"><i class="fas fa-search"></i></button>
                    </form>
                </div>
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
                        <a class="dropdown-item" href="/home" style="color: #000;">
                            Activitățile mele
			</a>
			@if(Auth::user()->isAdmin() || Auth::user()->isTeacher())
			<a class="dropdown-item" href="/course/create" style="color: #000;">
			    Cursuri
			</a>
			<a class="dropdown-item" href="/problem/create" style="color: #000;">
			    Probleme
			</a>
			@else 
			<a class="dropdown-item" href="/role/request/create" style="color: #000;">
			    Cerere rol
			</a>
			@endif
			@if(Auth::user()->isAdmin())
			<a class="dropdown-item" href="/role/request" style="color: #000;">
			    Cereri rol
			</a>
			@endif
			@if(Auth::user()->isTeacher())
			<a class="dropdown-item" href="/role/request/create" style="color: #000;">
			    Cerere rol
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
