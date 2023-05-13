@extends('layouts.app')

@section('content')
<div class="container bg-white p-5 mt-4 shadow">
    <test :test_id="{{$test->id}}"></test>
</div>
@endsection
