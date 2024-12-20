@extends("layouts.app")

@section("content")
	<div class="container mt-5 mb-5">
		<div class="row d-flex align-items-center justify-content-center">
			@foreach ($courses as $course)
				<div
					class="card m-2 shadow p-0"
					style="width: 18rem; height: 300px"
				>
					<a
						href="/course/{{ $course->id }}"
						style="text-decoration: none"
					>
						<div
							class="p-0 card-body background-index"
							style="
								background-image: -webkit-image-set(
									url('{{ asset($course->image) }}')
								);
								height: 145px;
								background-size: contain;
							"
						>
							<h6 class="pt-3 px-3 text-white card-title over">
								{{ $course->title }}
							</h6>
							<p class="px-3 card-text text-white over">
								{{ substr($course->description, 0, 50) }}
							</p>
						</div>
					</a>
					<ul class="list-group list-group-flush">
						@if ($course->levle)
							<li class="list-group-item">
								{{ $course->level }}
							</li>
						@else
							<li class="list-group-item">Incepator</li>
						@endif
						@if ($course->language)
							<li class="list-group-item">
								{{ $course->language }}
							</li>
						@else
							<li class="list-group-item">Romana</li>
						@endif
					</ul>
					<div class="card-body">
						<a
							href="{{ route("course.show", $course->id) }}"
							class="btn btn-primary"
						>
							Inscrie-te
						</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection
