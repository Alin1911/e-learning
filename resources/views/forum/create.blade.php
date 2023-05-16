@extends("layouts.app")

@section("content")
    <div>
        @include('widgets.slider_course_add', ['active' => 4])
        <div class="main-content container">
            <add-forum :courses="@json($courses)"></add-forum>
        </div>
    </div>
@endsection
