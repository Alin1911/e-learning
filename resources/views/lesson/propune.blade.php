@extends("layouts.app")

@section("content")
	<div class="container mt-5 mb-5">
		<div class="row d-flex align-items-center p-4 shadow bg-white">
			<div class="col-12">
				<h2>Propune lectie pentru cursul: {{ $course->title }}</h2>

				<form
					id="lessonForm"
					action="/lesson"
					method="POST"
					enctype="multipart/form-data"
				>
					@csrf
					@method("POST")
					<input
						type="hidden"
						name="course_id"
						value="{{ $course->id }}"
					/>
					<div class="form-group">
						<label for="title">Title</label>
						<input
							type="text"
							class="form-control"
							id="title"
							name="title"
							value=""
							required
						/>
					</div>

					<div class="form-group">
						<label for="argumente">Motivatie</label>
						<textarea
							class="form-control"
							id="argumente"
							name="argumente"
							rows="3"
							required
						></textarea>
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea
							class="form-control"
							id="description"
							name="description"
							rows="3"
							required
						></textarea>
					</div>

					<div class="form-group">
						<label for="content">Content</label>
						<textarea
							class="form-control"
							id="content"
							name="content"
							rows="10"
							required
						></textarea>
					</div>
					<div class="row my-2">
						<div class="form-group col-12">
							<label for="video">Încarcă un nou video</label>
							<input
								id="video"
								type="file"
								name="video"
								class="form-control"
							/>
						</div>
					</div>
					<div class="form-group">
						<label for="duration">Duration</label>
						<input
							type="text"
							class="form-control"
							id="duration"
							name="duration"
							value=""
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
					<button
						type="button"
						class="mt-3 btn btn-primary"
						onclick="submitLesson()"
					>
						Propune lectie
					</button>
				</form>
			</div>
		</div>
	</div>
	@se
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
		function submitLesson() {
			// Obțineți formularul și valorile câmpurilor
			const form = document.getElementById("lessonForm");
			const formData = new FormData(form);

			// Efectuați postul cu Axios
			axios
				.post("/lesson", formData)
				.then(function (response) {
					// Dacă răspunsul este OK, afișați un mesaj de succes și redirecționați
					if (response.status === 200) {
						alert("Lecția a fost propusă cu succes!");
						window.history.back(); // Redirecționați către pagina principală
					} else {
						alert(
							"A apărut o eroare. Vă rugăm să încercați din nou."
						);
					}
				})
				.catch(function (error) {
					alert("A apărut o eroare. Vă rugăm să încercați din nou.");
					console.error(error);
				});
		}
	</script>
@endsection
