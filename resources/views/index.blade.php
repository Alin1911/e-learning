@extends("layouts.app")

@section('title', 'Pantasmify - Începutul călătoriei tale în micro-learning')

@section("content")
	@include("widgets.slider")
	<div class="container bg-white p-5 mt-4 shadow">
		<div class="row justify-content-center py-5">
			<div class="col-md-12 text-center">
				<h1 class="mb-4">
					Descoperă Pantasmify - portalul tău de micro-learning
				</h1>
				<p class="lead">
					Îmbinăm libertatea cunoașterii cu eficiența
					micro-learning-ului. Pasiunea ta pentru învățare poate fi
					satisfăcută în moduri rapide și eficiente aici.
				</p>
				<a
					href="/course"
					class="btn shadow rounded-pill p-4 px-5 btn-primary btn-lg mt-4"
				>
					<strong>Descoperă Cursurile Noastre</strong>
				</a>
			</div>
		</div>
		<div class="row my-5 py-5">
			<!-- Include your micro-learning sections here -->
			@include("sections.quickLessons")
			@include("sections.flexibleLearning")
			@include("sections.learnerCommunity")
		</div>
		<div class="row mt-5">
			<div class="col-md-12 mx-auto text-center">
				@include("sections.moduleOfWeek")
			</div>
		</div>
	</div>
	<div
		class="row py-5 shadow text-white my-4 shadow-info"
		style="background-color: #4c88f2"
	>
		<div class="col-md-8 mx-auto text-center">
			<h2>Experiența Pantasmify</h2>
			<p class="lead h3 text-white">
				La Pantasmify, îți oferim nu doar cunoștințe, ci și o experiență
				de învățare adaptată nevoilor tale. Platforma noastră de
				micro-learning este concepută pentru a te ajuta să înveți în cel
				mai eficient și plăcut mod posibil.
			</p>
		</div>
	</div>
	<div class="container bg-white p-5 shadow">
		<div class="row my-5 py-5">
			<!-- Include more micro-learning sections -->
			@include("sections.userFriendly")
			@include("sections.variety")
			@include("sections.supportiveCommunity")
		</div>
		<div class="row mt-5">
			<div class="col-md-12 mx-auto text-center">
				<h2>Află mai multe despre Pantasmify</h2>
				<p class="lead">
					Ești curios să afli mai multe despre cum funcționează
					Pantasmify și ce te așteaptă după ce te înregistrezi?
					Vizitează secțiunea de Întrebări Frecvente sau
					contactează-ne direct.
				</p>
				<div class="row d-flex justify-content-center mb-5">
					<div class="col-md-6 d-flex justify-content-between">
						<a
							href="/term"
							class="btn btn-lg rounded-pill btn-info text-white"
							aria-label="Întrebări Frecvente"
						>
							Întrebări Frecvente
						</a>
						<a
							href="/contact"
							class="btn btn-lg rounded-pill btn-danger text-white"
							aria-label="Contactează-ne"
						>
							Contactează-ne
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
