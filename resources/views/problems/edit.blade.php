@extends("layouts.app")

@section("content")
	<div class="container bg-white p-5 mt-4 shadow">
		<h1>Editează #{{ $problem->id }} {{ $problem->title }}</h1>
		@include("problems.form", ["problem" => $problem])
	</div>
@endsection
