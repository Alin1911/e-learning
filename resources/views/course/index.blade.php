@extends('layouts.app')
  
@section('content')
<div class="container">
    @foreach($courses as $course)
        <div clas="row">
            <div class="col-md-4">
                <h3>{{ $course->title}}/h3>
                <p>{{ $course->description }}</p>
                <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary">View</a>
            </div>
        </div>
    @endforeach
</div>

@endsection
