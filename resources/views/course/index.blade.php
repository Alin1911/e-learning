@extends('layouts.app')
  
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        @foreach($courses as $course)
        <div class="card m-2" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="">
            <div class="card-body">
              <h5 class="card-title">{{ $course->title}}</h5>
              <p class="card-text">{{ $course->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
            <div class="card-body">
                <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary">Inscriete</a>
            </div>
          </div>
        @endforeach
    </div>
</div>
@endsection
