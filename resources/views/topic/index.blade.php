@extends("layouts.app")

@section("content")
	<div class="container p-5 mt-4">
		<topic-list forum_id="{{ $forum->id }}"></topic-list>
	</div>
@endsection
