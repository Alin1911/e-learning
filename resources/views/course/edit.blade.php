@extends('layouts.app')
  
@section('content')
<div>
   @include('widgets.slider_course_add', ['active' => 99, 'courses' => $courses])
    <div class="main-content container">
        <course-add :initial-course='@json($course)' :categories='@json($categories)'></course-add>
    </div>
</div>
@endsection
