@extends("layouts.app")

@section("content")
	<div class="container mt-5 mb-5">
		<div class="row d-flex align-items-center p-4 shadow bg-white">
			<div class="col-12">
				<h1>{{ $lesson->title }}</h1>
				<p>ID: {{ $lesson->id }}</p>
				<p><h4 class="border-bottom">Course:</h4> {{ $lesson->course->title }}</p>
				<p><h4 class="border-bottom">Description:</h4>{!! nl2br(e($lesson->description)) !!}</p>
				<p><h4 class="border-bottom">Content:</h4> {!! nl2br(e($lesson->content)) !!}</p>
				<p class="border-top pt-2">Video URL: {{ $lesson->video_url }}</p>
				<div class="row justify-content-center">
					<div class="col-md-8">
						@if (!empty($lesson->video_url))
							<div class="embed-responsive embed-responsive-16by9">
								<video class="embed-responsive-item" controls style="max-width: 100%; height: auto;">
									<source src="{{ $lesson->video_url }}" type="video/mp4">
									Browser-ul tău nu suportă elementul video.
								</video>
							</div>
						@endif
					</div>
				</div>
				<p class="border-top pt-2">Duration: {{ $lesson->duration }}</p>
				<p>File: {{ $lesson->file }}</p>
				<p>Is Published: {{ $lesson->is_published ? "Yes" : "No" }}</p>
				<p>Created at: {{ $lesson->created_at }}</p>
				<p>Updated at: {{ $lesson->updated_at }}</p>
				<p>Order: {{ $lesson->order }}</p>

				<h2>Tests</h2>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($lesson->tests as $test)
							<tr>
								<td>{{ $test->id }}</td>
								<td>{{ $test->title }}</td>
								<td>
									<a
										href="{{ route("test.show", $test->id) }}"
										class="btn btn-primary mx-1"
									>
										Show
									</a>
									<a
										href="{{ route("test.edit", $test->id) }}"
										class="btn btn-warning mx-1"
									>
										Edit
									</a>
									<form
										action="{{ route("test.destroy", $test->id) }}"
										method="POST"
										style="display: inline"
									>
										@csrf
										@method("DELETE")
										<button
											type="submit"
											class="btn btn-danger mx-1"
										>
											Delete
										</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<a
					href="{{ route("test.create", ["lesson_id" => $lesson->id]) }}"
					class="btn btn-success"
				>
					Add Test
				</a>
			</div>
		</div>
	</div>
@endsection
