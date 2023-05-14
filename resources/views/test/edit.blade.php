@extends('layouts.app')

@section('content')
<div class="container my-5 bg-light pb-5 pt-3 rounded shadow">
    <h1>Test#{{$test->id}}  {{$test->title}}</h1>
    <h2>Course: {{$test->course->title}}</h2>
    <div class="main-content container">
        @if(!empty($test->exercises))
        <hr>
        <h4> Exerciții: </h4>
        @foreach ($test->exercises as $e)
        <div class="d-flex justify-content-between p-2  border-bottom">
            <h5>{{$e->id}}. Întrebare: {{$e->question}}</h5>
            <button class="btn btn-danger rounded-pill" href="/exercise/{{$e->id}}/delete">Șterge exercițiu</button>
        </div>
        @endforeach
        @endif
        <div class="mt-3">
        <exercise-create :test_id="{{$test->id}}"></exercise-create>
        </div>
    </div>
</div>
@endsection

