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

				@if ($lesson->video_url)
					<div class="embed-responsive embed-responsive-16by9">
						<iframe
							class="embed-responsive-item"
							src="{{ $lesson->video_url }}"
							allowfullscreen
						></iframe>
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
		</div>
	</div>
@endsection
