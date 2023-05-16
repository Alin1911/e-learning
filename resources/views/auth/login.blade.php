@extends("layouts.app")

@section("content")
    <div class="container my-5 py-5">
        <form method="POST" action="{{ route("login") }}">
            @csrf
            <div
                class="px-3 py-4 row justify-content-center my-5 py-5 shadow bg-light"
            >
                <div class="border-bottom col-12 col-md-8 h2 py-2">
                    <strong>{{ __("Login") }}</strong>
                </div>
                <div class="mt-4 col-12 col-md-8 form-group my-1">
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
                                autofocus
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
                                autocomplete="current-password"
                            />
                            @error("password")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 mt-2">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div>
                                <input
                                    class="mr-2"
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    {{
                                        old("remember") ? "checked" : ""
                                    }}
                                />
                                <label
                                    class="form-check-label ml-2"
                                    for="remember"
                                >
                                    {{ __("Remember Me") }}
                                </label>
                            </div>

                            @if (Route::has("password.request"))
                                <div>
                                    <a
                                        class="p-0"
                                        href="{{ route("password.request") }}"
                                    >
                                        {{ __("Forgot Your Password?") }}
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 mt-2 mt-md-0">
                            <button
                                type="submit"
                                class="btn btn-primary col-12 rounded-pill"
                            >
                                {{ __("Login") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
