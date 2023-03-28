@extends('layouts.app')

@section('title', 'Pagina de start')

@section('content')
@include('widgets.slider')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <h1 class="mb-4">Bine ai venit la Platforma de eLearning</h1>
      <p class="lead">Aici vei gasi o varietate de cursuri si resurse online pentru a-ti dezvolta abilitatile si a-ti
        imbunatati cunostintele in diverse domenii.</p>
      <a href="#" class="btn btn-primary btn-lg my-4">Exploreaza Cursurile</a>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Cursuri Gratuite</h3>
          <p class="card-text">Acceseaza gratuit o selectie de cursuri online, acoperind diverse subiecte si niveluri de
            dificultate.</p>
          <a href="/course/free" class="btn btn-success">Inscrie-te Gratuit</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Cursuri Premium</h3>
          <p class="card-text">Ai acces la o varietate de cursuri premium, create de experti in domenii specifice si
            disponibile la preturi accesibile.</p>
          <a href="/course" class="btn btn-warning">Vezi Cursurile</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Comunitate</h3>
          <p class="card-text">Fii parte dintr-o comunitate activa de invatacei si mentori, impartasind idei si sfaturi
            si
            dezvoltandu-ti reteaua de contacte.</p>
          <a href="/about_us" class="btn btn-info">Afla Mai Multe</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection