@extends('layouts.app')
  
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        @foreach($exercises as $exercise)
        {{ $exercise->title}}
        {{ $exercise->description}}
        @endforeach
    </div>
</div>
@endsection
