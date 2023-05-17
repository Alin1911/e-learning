@extends("layouts.app")

@section("content")
	<div class="container my-5 py-5">
		<form method="POST" action="{{ route("register") }}">
			@csrf
			<div
				class="px-3 py-4 row justify-content-center my-5 py-5 shadow bg-light"
			>
				<div class="border-bottom col-12 col-md-8 h2 py-2">
					<strong>{{ __("Register") }}</strong>
				</div>
				<div class="mt-4 col-12 col-md-8 form-group my-1">
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label">
							{{ __("Name") }}
						</label>
						<div class="col-sm-10">
							<input
								id="name"
								type="text"
								class="my-input form-control @error("name")  is-invalid @enderror"
								name="name"
								value="{{ old("name") }}"
								required
								autocomplete="name"
								autofocus
							/>
							@error("name")
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 form-group my-1">
					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">
							{{ __("Email Address") }}
						</label>
						<div class="col-sm-10">
							<input
								id="email"
								type="email"
								class="my-input form-control @error("email")  is-invalid @enderror"
								name="email"
								value="{{ old("email") }}"
								required
								autocomplete="email"
							/>
							@error("email")
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 form-group my-1">
					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">
							{{ __("Password") }}
						</label>
						<div class="col-sm-10">
							<input
								id="password"
								type="password"
								class="my-input form-control @error("password")  is-invalid @enderror"
								name="password"
								required
								autocomplete="new-password"
							/>
							@error("password")
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 form-group my-1">
					<div class="form-group row">
						<label
							for="password-confirm"
							class="col-sm-2 col-form-label"
						>
							{{ __("Confirm Password") }}
						</label>
						<div class="col-sm-10">
							<input
								id="password-confirm"
								type="password"
								class="my-input form-control"
								name="password_confirmation"
								required
								autocomplete="new-password"
							/>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 form-group">
					<button
						type="submit"
						class="btn btn-primary col-12 rounded-pill"
					>
						{{ __("Register") }}
					</button>
				</div>
			</div>
		</form>
	</div>
@endsection
