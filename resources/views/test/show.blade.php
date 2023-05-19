@extends("layouts.app")

@section("content")
	<div>
		@include('widgets.slider_course_add', ['active' => 3])
		<div class="container bg-white p-5 mt-4 shadow">
			<test-component :test="{{ json_encode($test) }}"></test-component>
		</div>
	</div>
@endsection
