@extends('layouts.app')
  
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        @foreach($courses as $course)
        <div class="card m-2 shadow" style="width: 18rem; height: 370px;">
            <img class="card-img-top" src="..." alt="">
            <div class="card-body">
              <h6 class="card-title">{{ $course->title}}</h6>
              <p class="card-text">{{ substr($course->description, 0, 50); }}</p>
            </div>
            <ul class="list-group list-group-flush">
              @if($course->levle)
              <li class="list-group-item">
                {{$course->level}}
              </li>
              @else
              <li class="list-group-item">
                Incepator
              </li>
              @endif
              @if($course->language)
              <li class="list-group-item">
                  {{$course->language}}
                </li>
                @else
                <li class="list-group-item">
                  Romana
                </li>
                @endif
              @if($course->price)
              <li class="list-group-item">
                <div class="course-price mt-3">
                  @if($course->discount)
                    <span class="text-danger me-1">
                      <s>{{ $course->price }} RON</s>
                    </span>
                  @endif
                  @if($course->price)
                    <span>{{ $course->discount ? ($course->price - $course->discount) : $course->price }} RON</span>
                  @endif
                </div>
              </li>
              @else 
              <li class="list-group-item">
                Inscrie-te gratuit!
              </li>
              @endif
            </ul>
            <div class="card-body">
                <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary">Inscrie-te</a>
            </div>
          </div>
        @endforeach
    </div>
</div>
@endsection
