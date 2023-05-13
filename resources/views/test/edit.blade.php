@extends('layouts.app')

@section('content')
<div class="container my-5 bg-light pb-5 pt-3 rounded shadow">
    <h1>Test#{{$test->id}}  {{$test->title}}</h1>
    <h2>Course: {{$test->course->title}}</h2>
    <div class="main-content container">
        @foreach ($test->exercises as $e)
            {{$e->id}} <br>    
        @endforeach
        <exercise-create :test_id="{{$test->id}}"></exercise-create>
    </div>
</div>
@endsection

