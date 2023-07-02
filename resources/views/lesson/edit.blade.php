@extends("layouts.app")

@section("content")
	<div class="container mt-5 mb-5">
		<div class="row d-flex align-items-center p-4 shadow bg-white">
			<div class="col-12">
				<h1>Editare lectie: {{ $lesson->title }}</h1>
				<h2>Din cursul: {{ $lesson->course->title }}</h2>

				<form
					action="{{ route("lesson.update", $lesson->id) }}"
					method="POST"
					enctype="multipart/form-data"
				>
					@csrf
					@method("PUT")
@if(isset( $lesson->argumente))
<div class="col-12">
	<h4> Motiv: {{$lesson->argumente}} </h4>
</div>
@endif
					<div class="form-group">
						<label for="title">Title</label>
						<input
							type="text"
							class="form-control"
							id="title"
							name="title"
							value="{{ $lesson->title }}"
							required
						/>
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea
							class="form-control"
							id="description"
							name="description"
							rows="3"
							required
						>
{{ $lesson->description }}</textarea
						>
					</div>

					<div class="form-group">
						<label for="content">Content</label>
						<textarea
							class="form-control"
							id="content"
							name="content"
							rows="10"
							required
						>
{{ $lesson->content }}</textarea
						>
					</div>
					<div class="row my-2">
						<div class="form-group col-9">
							<label for="video">Încarcă un nou video</label>
							<input
								id="video"
								type="file"
								name="video"
								class="form-control"
							/>
						</div>
						<div class="form-group col-3 mt-3">
							@if (! empty($lesson->video_url))
								<video controls>
									<source
										src="{{ Storage::url($lesson->video_url) }}"
										type="video/mp4"
									/>
									Browser-ul tău nu suportă elementul video.
								</video>
							@else
								<p>Nu există video pentru această lecție.</p>
							@endif
						</div>
					</div>
					<div class="form-group">
						<label for="duration">Duration</label>
						<input
							type="text"
							class="form-control"
							id="duration"
							name="duration"
							value="{{ $lesson->duration }}"
							required
						/>
					</div>

					<div class="form-group form-check my-3">
						<input
							type="checkbox"
							class="form-check-input"
							id="is_published"
							name="is_published"
							{{ $lesson->is_published ? "checked" : "" }}
						/>
						<label class="form-check-label" for="is_published">
							Is Published
						</label>
					</div>

					<div class="form-group">
						<label for="order">Order</label>
						<input
							type="number"
							class="form-control"
							id="order"
							name="order"
							value="{{ $lesson->order }}"
							required
						/>
					</div>
					<div class="form-group">
						<label for="file">File</label>
						<input
							type="file"
							class="form-control"
							id="file"
							name="file"
						/>
					</div>
					<button type="submit" class="mt-3 btn btn-primary">
						Actualizare lectien
					</button>
				</form>
			</div>
		</div>
	</div>
@endsection
