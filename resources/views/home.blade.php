@extends('layouts.app')

@section('content')
<div class="container mt-5 p-3 shadow bg-light">
    <div class="row ">
        <div class="col-md-12">
            <h2 class="mb-4">{{ __('Dashboard') }}</h2>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h4>{{ __('Cursurile la care ești înscris:') }}</h4>
            <div class="row">
                @foreach($learningCourses as $learningCourse)
                <!-- Înlocuiți cu un ciclu foreach care parcurge cursurile utilizatorului și afișează informațiile relevante despre fiecare curs -->
                <div class="col-md-4">
                    <div class="card mb-4 p-3">
                        <img src="URL imagine curs" class="card-img-top" alt="Imagine curs">
                        <div class="card-body">
                            <h5 class="card-title">{{$learningCourse->title}}</h5>
                            <p class="card-text">Descriere scurtă a cursului</p>
                            <a href="URL curs" class="btn btn-primary">Accesează cursul</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Sfârșitul exemplului de card curs -->
            </div>
            <hr>
            <h4 class="mt-4">{{ __('Citate inspiraționale') }}</h4>
            <blockquote class="blockquote">
                <p>"Educația este cea mai puternică armă pe care o poți folosi pentru a schimba lumea."</p>
                <footer class="blockquote-footer">Nelson Mandela</footer>
            </blockquote>
            <blockquote class="blockquote">
                <p>"Învățarea este ca și remurile pe o barcă, te ajută să te îndrepți înainte, iar când încetezi să înveți, ești purtat de valurile vieții."</p>
                <footer class="blockquote-footer">Autor necunoscut</footer>
            </blockquote>
        </div>
    </div>
</div>
@endsection