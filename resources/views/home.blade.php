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

				@if (count($user->learningCourses))
					<h3>{{ __("Cursurile tale:") }}</h3>
					<hr class="text-danger bg-danger" />
					<div class="row">
						@foreach ($user->learningCourses as $learningCourse)
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
										<div
											class="d-flex justify-content-between"
										>
											<a
												href="/learn/course/{{ $learningCourse->id }}"
												class="btn btn-primary"
											>
												Accesează cursul
											</a>
											<a
												href="/course/leave/{{ $learningCourse->id }}"
												class="btn btn-danger"
											>
												Parăsește cursul
											</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<h3 class="text-center m-5 pb-2">
						Nu ești înscris la niciun curs
					</h3>
				@endif
				@if (count($user->posts))
					<h3 class="border-bottom border-primary mb-3 pb-2">
						Discuții în care ești implicat
					</h3>
					<div
						id="carouselExampleIndicators"
						class="carousel slide mt-4"
						data-ride="carousel"
					>
						<div class="carousel-inner shadow bg-light p-2">
							@foreach ($user->posts as $index => $post)
								<div
									class="carousel-item @if($index == 0) active @endif"
									style="min-height: 200px"
								>
									<div
										class="m-5 row d-flex justify-content-center"
									>
										<div
											class="mx-5 col-6 d-flex justify-content-between"
										>
											<h4>
												{{ $post->topic->forum->title }}
											</h4>
											<a
												class="btn btn-success"
												href="/forums/{{ $post->topic->forum->id }}"
											>
												Acceseaza forumul
											</a>
										</div>
										<div
											class="mx-5 col-6 d-flex justify-content-between mt-1"
										>
											<h4>{{ $post->topic->title }}</h4>
											<a
												class="btn btn-success"
												href="/topics/{{ $post->topic->id }}"
											>
												Acceseaza discuția
											</a>
										</div>
										<div class="col-6 mt-4">
											<h3 class="">Postarea ta:</h3>
											<p>{{ $post->content }}</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						<a
							class="carousel-control-prev"
							href="#carouselExampleIndicators"
							role="button"
							data-slide="prev"
						>
							<span class="text-dark">
								<i class="fa-solid fa-angle-left"></i>
							</span>
						</a>
						<a
							class="carousel-control-next"
							href="#carouselExampleIndicators"
							role="button"
							data-slide="next"
						>
							<span class="text-dark">
								<i class="fa-solid fa-angle-right"></i>
							</span>
						</a>
					</div>
				@else
					<hr class="text-danger bg-danger" />
					<h3 class="text-center m-5 pb-2">
						Nu ești implicat în nicio discuție
					</h3>
				@endif
				<hr class="text-danger bg-danger" />
				<h3 class="py-3">
					Câteva citate motivaționale pentru a te ajuta să înveți mai
					bine
				</h3>
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
				<blockquote class="blockquote">
					<p>
						"Învață din ieri, trăiește pentru azi, speră pentru
						mâine. Cel mai important lucru este să nu încetezi să te
						întrebi."
					</p>
					<footer class="blockquote-footer">Albert Einstein</footer>
				</blockquote>
			</div>
		</div>
	</div>
@endsection
