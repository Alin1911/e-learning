@extends('layouts.app')
  
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center p-4 shadow bg-white">
        <div class="col-12">
        <h1>{{ $forum->title}}</h1>
        <br>
        {{ $forum->description}}
        </div>
    </div>
</div>
@endsection
