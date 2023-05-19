@extends("layouts.app")

@section("content")
	<div class="container my-5 py-5">
		<div class="px-3 py-4 row justify-content-center my-5 py-5 shadow bg-light"
			>
				<div class=" col-12 col-md-8 py-2">
					<strong class="h2">
						{{ __("Reset Password") }}
					</strong>
					<div class="pt-4 col-12 form-group my-1 border-top">
						@if (session("status"))
							<div class="alert alert-success" role="alert">
								{{ session("status") }}
							</div>
						@endif
						<form
							method="POST"
							action="{{ route("password.email") }}"
						>
							@csrf
							<div class="form-group row">
								<label
									for="email"
									class="col-sm-2 col-form-label"
								>
									{{ __("Email Address") }}
								</label>

								<div class="col-sm-10">
									<input
									id="email"
									type="email"
									class="my-input form-control @error("name")  is-invalid @enderror"
									name="name"
									value="{{ old("email") }}"
									required
									autocomplete="email"
									autofocus
								/>

									@error("email")
										<span
											class="invalid-feedback"
											role="alert"
										>
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="row mb-0 mt-4">
								<div class="col-md-6 offset-md-4">
									<button
										type="submit"
										class="btn btn-primary"
									>
										{{ __("Send Password Reset Link") }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
