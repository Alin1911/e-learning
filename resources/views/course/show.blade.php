@extends('layouts.app')

@section('content')
<div>
    <course :course="{{ json_encode($course) }}"></course>
</div>
@endsection

