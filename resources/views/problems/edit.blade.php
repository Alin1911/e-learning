@extends("layouts.app")

@section("content")
	<div class="container bg-white p-5 mt-4 shadow">
		<h1>Adauga un exercitiu public</h1>
		@include("problems.form", ["problem" => $problem])
	</div>
@endsection
