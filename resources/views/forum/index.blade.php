@extends('layouts.app')
  
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        @foreach($forums as $forum)
        <div class="col-12">
            <div class="row d-flex align-items-center p-4 shadow bg-white">
                <div class="col-12 d-flex justify-content-between">
                    <div>
                    <h1>{{ $forum->title }}</h1>
                    <br>
                    <p>{{ $forum->description }}</p>
                    </div>
                    <div class="mt-4 d-flex align-items-end mb-3">
                        <a href="/forum/{{$forum->id}}" class="btn btn-primary">Vezi discuția</a>
                        
                        @can('create', App\Models\Forum::class) {{-- Verifică dacă utilizatorul are permisiunea de a crea un nou forum --}}
                            <a href="{{ route('forum.create') }}" class="btn btn-success">Creează un nou forum</a>
                        @endcan
                        
                        @can('update', $forum) {{-- Verifică dacă utilizatorul are permisiunea de a edita forumul curent --}}
                            <a href="{{ route('forum.edit', $forum->id) }}" class="btn btn-info">Editează forumul</a>
                        @endcan
                        
                        @can('delete', $forum) {{-- Verifică dacă utilizatorul are permisiunea de a șterge forumul curent --}}
                            <form action="{{ route('forum.destroy', $forum->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Șterge forumul</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
