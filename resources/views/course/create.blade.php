@extends('layouts.app')

@section('content')
<div>
   @include('widgets.slider_course_add', ['active' => 1])
<div class="main-content container">
    <course-add :categories={{$categories}}></course-add>
</div>
</div>
@endsection

