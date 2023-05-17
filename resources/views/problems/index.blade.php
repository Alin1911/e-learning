@extends("layouts.app")

@section("content")
	<div class="container">
		<problem-list
			:exercises="{{ json_encode($exercises) }}"
		></problem-list>
	</div>
@endsection
