@extends('layouts.app')

@section('content')
<div>
   @include('widgets.slider_course_add', ['active' => 3])
    <div class="main-content container">
        <test-create :courses='@json($courses)'></test-create>
    </div>
</div>
@endsection

