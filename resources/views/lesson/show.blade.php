@extends("layouts.app")

@section("content")
	<div class="container mt-5 mb-5">
		<div class="row d-flex align-items-center p-4 shadow bg-white">
			<div class="col-12">
				<h1>{{ $lesson->title }}</h1>
				<p>ID: {{ $lesson->id }}</p>
				<p>Course: {{ $lesson->course->title }}</p>
				<p>Description: {{ $lesson->description }}</p>
				<p>Content: {!! $lesson->content !!}</p>
				<p>Video URL: {{ $lesson->video_url }}</p>
				<p>Duration: {{ $lesson->duration }}</p>
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
