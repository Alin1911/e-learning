@extends("layouts.app")

@section('title', 'LearningHub - Începutul cunoașterii tale')

@section("content")
    @include("widgets.slider")
    <div class="container bg-white p-5 mt-4 shadow">
        <div class="row justify-content-center py-5">
            <div class="col-md-12 text-center">
                <h1 class="mb-4">
                    Descoperă LearningHub - portalul tău spre cunoaștere
                </h1>
                <p class="lead">
                    Sărbătorim libertatea cunoașterii și accesul deschis la învățare. Pasiunea ta pentru învățare nu are bariere aici.
                </p>
                <a href="#" class="btn btn-primary btn-lg my-4">
                    Descoperă Cursurile
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <!-- Add your sections here -->
            @include('sections.variety')
            @include('sections.specialized')
            @include('sections.community')
        </div>
        <div class="row mt-5">
            <div class="col-md-12 mx-auto text-center">
			@include('sections.course_week')
		</div>
	</div>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto text-center">
                <h2>Experiența LearningHub</h2>
                <p class="lead">
                    La LearningHub, îți oferim nu doar cunoștințe, ci și o experiență. Prin urmare, platforma noastră este concepută pentru a te ajuta să înveți în cel mai eficient și plăcut mod posibil.
                </p>
            </div>
        </div>
        <div class="row mt-5">
            <!-- Add more sections -->
            @include('sections.userFriendly')
            @include('sections.interactive')
            @include('sections.supportive')
        </div>
        <div class="row mt-5">
            <div class="col-md-12 mx-auto text-center">
                <h2>Află mai multe despre LearningHub</h2>
                <p class="lead">
                    Ești curios să afli mai multe despre cum funcționează LearningHub și ce te așteaptă după ce te înregistrezi? Vizitează secțiunea de Întrebări Frecvente sau contactează-ne direct.
                </p>
				<div class="row d-flex justify-content-center mb-5">
					<div class="col-md-6 d-flex justify-content-between">
                		<a href="/faq" class="btn btn-info">Întrebări Frecvente</a>
                		<a href="/contact" class="btn btn-info">Contactează-ne</a>
					</div>
				</div>
            </div>
        </div>
		<div class="row mt-5">
			<div class="col-md-12 mx-auto text-center">
				@include('sections.testimonial')
				</div>
			</div>
		</div>
    </div>
@endsection
