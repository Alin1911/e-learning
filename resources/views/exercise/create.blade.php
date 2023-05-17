@extends("layouts.app")

@section("content")
	<div>
		@include('widgets.slider_course_add',['active'=>2])
		<div class="main-content container">
			<exercise-create></exercise-create>
		</div>
	</div>
@endsection
