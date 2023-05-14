@extends('layouts.app')

@section('content')
<div class="container bg-white p-5 mt-4 shadow">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $lesson->course->title }}</h2>
                </div>
                <div class="card-body">
                    <h3>{{ $lesson->title }}</h3>
                    <p>{{ $lesson->description }}</p>

                    @if ($lesson->video_url)
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{ $lesson->video_url }}" allowfullscreen></iframe>
                        </div>
                    @endif

                    @if ($lesson->content)
                        <div class="lesson-content">
                            {!! $lesson->content !!}
                        </div>
                    @endif

                    @if ($lesson->file)
                        <a href="{{ asset($lesson->file) }}" target="_blank" class="btn btn-primary">Descarcă fișierul atașat</a>
                    @endif

                    <hr>

                    <h4>Teste pentru această lecție:</h4>
                    <ul>
                        @foreach ($lesson->tests as $test)
                            <li>
                                <strong>{{ $test->title }}</strong> - {{ $test->description }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
