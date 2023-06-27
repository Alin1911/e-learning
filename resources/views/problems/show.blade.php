@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-0 rounded-0">
                <div class="card-header">
                    <h3>{{ $problem->title }}</h3>
                </div>

                <div class="card-body">
                    <h5>Descriere:</h5>
                    <p>{{ $problem->description }}</p>

                    @if($problem->pairs && $problem->pairs != "{}")
                    <h5>Perechi:</h5>
                    @php $pairs = json_decode($problem->pairs, true) @endphp
                    <ul>
                        @if(is_object(json_decode($pairs)))
                        @foreach($pairs as $key => $pair)
                            <li>{{ $key }}: {{ $pair }}</li>
                        @endforeach
                        @else
                        <li>{{ $pairs }}</li>
                        @endif
                    </ul>
                    @endif

                    @if($problem->results && $problem->results != "{}")
                    <h5>Rezultate:</h5>
                    @php $results = json_decode($problem->results, true) @endphp
                    <ul>
                        @if(is_object(json_decode($results)))
                        @foreach($results as $result)
                            <li>{{ $result['key'] }}: {{ $result['value'] }}</li>
                        @endforeach
                        @else
                        <li>{{ $results }}</li>
                        @endif
                    </ul>
                    @endif

                    @if($problem->example)
                    <h5>Exemplu:</h5>
                    <p>{{ $problem->example }}</p>
                    @endif

                    @if($problem->hints)
                    <h5>Indicii:</h5>
                    <p>{{ $problem->hints }}</p>
                    @endif

                    @if($problem->restrictions)
                    <h5>Restricții:</h5>
                    <p>{{ $problem->restrictions }}</p>
                    @endif

                    @if($problem->similar_problems)
                    <h5>Probleme similare:</h5>
                    <p>{{ $problem->similar_problems }}</p>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-between ">
                    @if(auth()->check() && ( Auth::user()->hasRole('admin') || Auth::user()->id == $problem->user_id))
                    <div>
                        <a href="/problem/{{$problem->id}}/edit" class="btn btn-primary">Editează</a>
                        <button class="btn btn-danger mx-2" onclick="delete1({{$problem->id}})">Șterge</button>
                    </div>
                    @endif
                    <a href="/problem" class="btn btn-secondary">Înapoi la lista de probleme</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    function delete1(id) {
            axios.delete('/problem/' + id)
                .then(function(response) {
                    window.location.href = '/problem';
                })
                .catch(function(error) {
                    console.log(error);
                });
    };
</script>
@endsection
