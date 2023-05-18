@extends("layouts.app")

@section("content")
	<div class="container my-5 bg-light pb-5 pt-3 rounded shadow">
		<account-menu :user="{{ json_encode($user) }}"></account-menu>
	</div>
@endsection
