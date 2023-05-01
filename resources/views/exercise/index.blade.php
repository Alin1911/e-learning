@extends('layouts.app')
  
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        @foreach($exercises as $exercise)
        <div class="col-12 p-3 bg-white shadow my-3">
        <h4>{{$exercise->title}}</h4>
        <br>
        <p>
        {{ $exercise->description}}
        </p>
        </div>
        @endforeach
    </div>
</div>
@endsection
