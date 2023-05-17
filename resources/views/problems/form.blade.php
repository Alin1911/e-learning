<form
	action="{{ isset($problem) ? "problem" . $problem->id : "/problem" }}"
	method="POST"
>
	@csrf
	@if (isset($problem))
		@method("PUT")
	@endif

	<div class="form-group">
		<label for="title">Title</label>
		<input
			type="text"
			name="title"
			id="title"
			class="form-control"
			value="{{ old("title", isset($problem) ? $problem->title : "") }}"
			required
		/>
	</div>

	<div class="form-group">
		<label for="description">Description</label>
		<textarea
			name="description"
			id="description"
			class="form-control"
			required
		>
{{ old("description", isset($problem) ? $problem->description : "") }}</textarea
		>
	</div>

	<div class="form-group">
		<label for="t">T</label>
		<input
			type="number"
			name="t"
			id="t"
			class="form-control"
			value="{{ old("t", isset($problem) ? $problem->t : "") }}"
			required
		/>
	</div>

	<div class="form-group">
		<label for="pairs">Pairs</label>
		<input
			type="text"
			name="pairs"
			id="pairs"
			class="form-control"
			value="{{ old("pairs", isset($problem) ? json_encode($problem->pairs) : "") }}"
			required
		/>
	</div>

	<div class="form-group">
		<label for="results">Results</label>
		<input
			type="text"
			name="results"
			id="results"
			class="form-control"
			value="{{ old("results", isset($problem) ? json_encode($problem->results) : "") }}"
		/>
	</div>

	<div class="form-group">
		<label for="restrictions">Restrictions</label>
		<textarea name="restrictions" id="restrictions" class="form-control">
{{ old("restrictions", isset($problem) ? $problem->restrictions : "") }}</textarea
		>
	</div>

	<div class="form-group">
		<label for="example">Example</label>
		<textarea name="example" id="example" class="form-control">
{{ old("example", isset($problem) ? $problem->example : "") }}</textarea
		>
	</div>

	<div class="form-group">
		<label for="hints">Hints</label>
		<textarea name="hints" id="hints" class="form-control">
{{ old("hints", isset($problem) ? $problem->hints : "") }}</textarea
		>
	</div>

	<div class="form-group">
		<label for="similar_problems">Similar Problems</label>
		<textarea
			name="similar_problems"
			id="similar_problems"
			class="form-control"
		>
{{ old("similar_problems", isset($problem) ? $problem->similar_problems : "") }}</textarea
		>
	</div>

	<button type="submit" class="mt-2 btn btn-primary">
		{{ isset($problem) ? "Update" : "Create" }}
	</button>
</form>
