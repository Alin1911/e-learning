@if (isset($moduleOfWeek))
	<div class="col-md-12">
		<div class="jumbotron bg-light text-center">
			<h3 class="display-4">Modulul săptămânii</h3>
			<p class="lead">
				Săptămâna aceasta, învață mai multe despre
				<strong>{{ $moduleOfWeek->title }}</strong>
				în doar câteva minute pe zi!
			</p>
			<hr class="my-4" />
			<p>{{ $moduleOfWeek->description }}</p>
			<a
				class="btn btn-primary btn-lg"
				href="/course/{{ $moduleOfWeek->id }}"
				role="button"
			>
				Începe acum
			</a>
		</div>
	</div>
@endif
