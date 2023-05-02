@extends('layouts.app')

@section('content')
<div class="container bg-white p-5 mt-4 shadow">
    <course-manager :course="{{ json_encode($course) }}" :course_id="{{ $course->id }}"></course-manager>
</div>
@endsection

