@extends("layouts.app")

@section("content")
    <div class="container p-5 mt-4">
        <topic-view topic_id="{{ $topic->id }}"></topic-view>
    </div>
@endsection
