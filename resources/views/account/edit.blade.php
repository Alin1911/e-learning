@extends("layouts.app")

@section("content")
<div class="container d-flex justify-content-center">
	<div class="col-12 shadow my-5 p-3 bg-white">
    <h1>Editare utilizator</h1>
    <form action="{{ route('account.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nume:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
		</div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Data nașterii:</label>
            <input type="date" id="birthdate" name="birthdate" value="{{ $user->birthdate }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="profession">Profesie:</label>
            <input type="text" id="profession" name="profession" value="{{ $user->profession }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="interests">Interese:</label>
            <textarea id="interests" name="interests" class="form-control">{{ $user->interests }}</textarea>
        </div>

        <div class="form-group">
            <label for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="country">Țară:</label>
            <input type="text" id="country" name="country" value="{{ $user->country }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Salvează modificările</button>
    </form>
	</div>
</div>

@endsection
