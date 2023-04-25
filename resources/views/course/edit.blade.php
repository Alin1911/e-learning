@extends('layouts.app')
  
@section('content')
<div class="container bg-white mt-5 mb-5 shadow py-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mb-3">
            <h1 class="card-title">{{ $course->title}}</h1>
        </div>
        <div class="col-12 mb-3">
            <p class="card-text">{{ $course->description }}</p>
        </div>
        <div class="col-auto">
            <a href="/course/{{ $course->id }}/join" class="btn btn-danger shadow">Inscriete</a>
        </div>
    </div>
</div>
@endsection
