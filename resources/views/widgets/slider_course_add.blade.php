<button
	id="menuToggle"
	class="btn btn-white bg-white pr-3 py-5 rounded-pill"
	style="
		z-index: 0;
		position: absolute;
		top: 35%;
		border-top-left-radius: 0 !important;
		border-bottom-left-radius: 0 !important;
	"
>
	<i class="fas fa-bars"></i>
</button>

<div id="sidebar" class="sidebar">
	<div class="position-sticky">
		<div class="list-group list-group-flush mt-5">
			<a
				href="/course/create"
				class="list-group-item list-group-item-action py-3 px-5 ripple @if($active == 1) active @endif"
				aria-current="true"
			>
				<i class="fas fa-solid fa-book fa-fw me-3"></i>
				<span>Adaugare curs</span>
			</a>
			<a
				href="/lesson/create"
				class="list-group-item list-group-item-action px-5 py-3 ripple @if($active == 2) active @endif"
			>
				<i class="fas fa-solid fa-person-chalkboard fa-fw me-3"></i>
				<span>Adauga lectie</span>
			</a>
			<a
				href="/test/create"
				class="list-group-item list-group-item-action py-3 px-5 ripple @if($active == 3) active @endif"
			>
				<i class="fas fa-duotone fa-check-double fa-fw me-3"></i>
				<span>Adauga Test</span>
			</a>
			@if (! @empty($courses))
				<div class="btn-group">
					<button
						type="button"
						class="btn btn-warning rounded-0 border dropdown-toggle py-3"
						data-toggle="dropdown"
						aria-haspopup="true"
						aria-expanded="false"
					>
						<h5>Cursurile tale</h5>
					</button>
					<div class="dropdown-menu p-0" style="width: 240px">
						@foreach ($courses as $course)
							<a
								class="dropdown-item border-bottom py-2 text-wrap"
								href="/course/{{ $course->id }}/edit"
							>
								{{ $course->title }}
							</a>
						@endforeach
					</div>
				</div>
			@endif
		</div>
	</div>
</div>

@section("scripts")
	<script>
		const menuToggle = document.getElementById("menuToggle");
		const sidebar = document.getElementById("sidebar");

		menuToggle.addEventListener("click", function () {
			sidebar.classList.toggle("active");
			menuToggle.classList.toggle("active1");
		});

		menuToggle.addEventListener("mouseenter", function () {
			sidebar.classList.add("active");
			menuToggle.classList.add("active1");
		});

		sidebar.addEventListener("mouseleave", function () {
			sidebar.classList.remove("active");
			menuToggle.classList.remove("active1");
		});
	</script>
@endsection
