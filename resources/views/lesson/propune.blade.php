@extends("layouts.app")

@section("content")
	<div class="container mt-5 mb-5">
		<div class="row d-flex align-items-center p-4 shadow bg-white">
			<div class="col-12">
				<h2>Propune lectie pentru cursul: {{ $course->title }}</h2>

				<form
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
					<div class="form-group">
						<label for="argumente">
							Argumentează de ce ar fi utilă aceeastă lecție
						</label>
						<textarea
							class="form-control"
							id="argumente"
							name="argumente"
							rows="3"
							required
						></textarea>
					</div>
					<button type="submit" class="mt-3 btn btn-primary">
						Propune lectie
					</button>
				</form>
			</div>
		</div>
	</div>
@endsection
