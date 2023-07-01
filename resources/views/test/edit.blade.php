@extends("layouts.app")

@section("content")
	<div class="container my-5 bg-light pb-5 pt-3 rounded shadow">
		<h1>Test#{{ $test->id }} {{ $test->title }}</h1>
		<h2>Course: {{ $test->course->title }}</h2>
		<div class="main-content container">
			@if (! empty($test->exercises))
				<hr />
				<h4>Exerciții:</h4>
				@foreach ($test->exercises as $e)
					<div
						class="d-flex justify-content-between p-2 border-bottom"
					>
						<h5>{{ $e->id }}. Întrebare: {{ $e->question }}</h5>
						<button
							class="btn btn-danger rounded-pill delete-exercise-btn"
							data-exercise-id="{{ $e->id }}"
						>
							Șterge exercițiu
						</button>
					</div>
				@endforeach
			@endif

			<div class="mt-3">
				<exercise-create :test_id="{{ $test->id }}"></exercise-create>
			</div>
		</div>
	</div>
@endsection

@section("scripts")
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
		var deleteButtons = document.querySelectorAll(".delete-exercise-btn");
		deleteButtons.forEach(function (button) {
			button.addEventListener("click", function () {
				var exerciseId = button.dataset.exerciseId;
				deleteExercise(exerciseId);
			});
		});

		function deleteExercise(exerciseId) {
			axios
				.delete("/exercise/" + exerciseId)
				.then(function (response) {
					// Verificați dacă răspunsul JSON de la server conține succes
					if (response.data.success) {
						// Afișați o alertă de succes
						alert("Exercițiul a fost șters cu succes!");

						// Actualizați sau reîncărcați pagina, dacă este necesar
						// window.location.reload();
					} else {
						// Afișați o alertă de eroare în cazul în care ștergerea a eșuat
						alert("A apărut o eroare la ștergerea exercițiului.");
					}
				})
				.catch(function (error) {
					// Gestionați eventualele erori în cazul în care cererea Ajax a eșuat
					console.error(error);
				});
		}
	</script>
@endsection
