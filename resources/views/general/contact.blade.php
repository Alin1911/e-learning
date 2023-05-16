@extends("layouts.app")

@section("content")
    <div class="container mt-5 bg-light p-3 shadow">
        <h2>Contactează-ne</h2>
        <p>
            Dacă aveți întrebări, sugestii sau comentarii, vă rugăm să ne
            contactați folosind formularul de mai jos sau prin e-mail la
            <a href="mailto:suport@platforma-elearning.ro">
                suport
                @platforma-elearning
                .ro
            </a>
            .
        </p>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nume</label>
                <input type="text" class="form-control" id="name" required />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresa de e-mail</label>
                <input type="email" class="form-control" id="email" required />
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subiect</label>
                <input type="text" class="form-control" id="subject" required />
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mesaj</label>
                <textarea
                    class="form-control"
                    id="message"
                    rows="4"
                    required
                ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Trimite mesaj</button>
        </form>
    </div>
@endsection
