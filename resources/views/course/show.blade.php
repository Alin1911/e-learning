@extends("layouts.app")

@section("content")
    <div class="container bg-white p-5 mt-4 shadow">
        <course :course="{{ json_encode($course) }}"></course>
    </div>
@endsection
