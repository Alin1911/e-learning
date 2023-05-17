@extends("layouts.app")

@section("content")
	<div class="container mt-5 p-4 shadow bg-light">
		<div class="row">
			<div class="col-md-12">
				@if (session("status"))
					<div class="alert alert-success" role="alert">
						{{ session("status") }}
					</div>
				@endif

				<h3>{{ __("Cursurile tale:") }}</h3>
				<hr class="text-danger bg-danger" />
				<div class="row">
					@foreach ($learningCourses as $learningCourse)
						<!-- Înlocuiți cu un ciclu foreach care parcurge cursurile utilizatorului și afișează informațiile relevante despre fiecare curs -->
						<div class="col-md-4">
							<div class="card mb-4 p-3 border-0 shadow">
								@if (isset($learningCourse->image))
									<img
										src="{{ asset($learningCourse->image) }}"
										class="card-img-top"
										alt="Imagine curs"
										height="215"
									/>
								@endif

								<div class="card-body">
									<h5 class="card-title">
										{{ $learningCourse->title }}
									</h5>
									<p class="card-text">
										{{ $learningCourse->level }} -
										{{ $learningCourse->duration }}
									</p>
									<div class="d-flex justify-content-between">
										<a
											href="/learn/course/{{ $learningCourse->id }}"
											class="btn btn-primary"
										>
											Accesează cursul
										</a>
										<a
											href="/learn/course/leave/{{ $learningCourse->id }}"
											class="btn btn-danger"
										>
											Parăsește cursul
										</a>
									</div>
								</div>
							</div>
						</div>
					@endforeach

					<!-- Sfârșitul exemplului de card curs -->
				</div>
				<hr class="text-danger bg-danger" />
				<blockquote class="blockquote">
					<p>
						"Educația este cea mai puternică armă pe care o poți
						folosi pentru a schimba lumea."
					</p>
					<footer class="blockquote-footer">Nelson Mandela</footer>
				</blockquote>
				<blockquote class="blockquote">
					<p>
						"Învățarea este ca și remurile pe o barcă, te ajută să
						te îndrepți înainte, iar când încetezi să înveți, ești
						purtat de valurile vieții."
					</p>
					<footer class="blockquote-footer">Autor necunoscut</footer>
				</blockquote>
			</div>
		</div>
	</div>
@endsection
