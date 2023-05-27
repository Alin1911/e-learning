@extends("layouts.app")

@section("content")
	<div class="container bg-white p-5 mt-4 shadow">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="border-bottom mb-3 border-primary">
					<h3>{{ $lesson->title }}</h3>
				</div>
				@if (! empty($lesson->description))
					<div>
						<p>{!! nl2br(e($lesson->description)) !!}</p>
					</div>
				@endif

				@if (! empty($lesson->video_url))
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div
								class="embed-responsive embed-responsive-16by9"
							>
								<video
									class="embed-responsive-item"
									controls
									style="max-width: 100%; height: auto"
								>
									<source
										src="{{ $lesson->video_url }}"
										type="video/mp4"
									/>
									Browser-ul tău nu suportă elementul video.
								</video>
							</div>
						</div>
					</div>
				@endif

				@if ($lesson->content)
					<div class="lesson-content">
						<p>
							{!! nl2br(e($lesson->content)) !!}
						</p>
					</div>
				@endif

				@if ($lesson->file)
					<div>
						<a
							href="{{ asset($lesson->file) }}"
							target="_blank"
							class="btn btn-primary"
						>
							Descarcă fișierul atașat
						</a>
					</div>
				@endif
			</div>
			<button
				class="btn btn-success mt-3"
				onclick="finishLesson({{ $lesson->id }})"
			>
				Completează lecția
			</button>
		</div>
	</div>
@endsection

@section("scripts")
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
		function finishLesson(lessonId) {
			var token = document.head.querySelector(
				'meta[name="csrf-token"]'
			).content;
			axios.defaults.headers.common["X-CSRF-TOKEN"] = token;
			axios
				.post("/lesson/finish", {
					lessonId: lessonId,
				})
				.then(function (response) {
					console.log(response);
					window.location.href = "/course/" + response.data.courseId;
				})
				.catch(function (error) {
					console.log(error);
				});
		}
	</script>
@endsection
