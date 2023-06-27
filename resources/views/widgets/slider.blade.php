<div id="carouselExampleCaptions" class="carousel slide mb-5 shadow-sm" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($courses as $index => $course)
            <li data-target="#carouselExampleCaptions" data-slide-to="{{ $index }}" @if($index == 0) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($courses as $index => $course)
            <div class="carousel-item @if($index == 0) active @endif" style="text-shadow: 1px 1px 2px red, 0 0 1em blue, 0 0 0.2em blue;">
                <img class="d-block w-100" src="{{ asset($course->image) }}" alt="{{ $course->name }}" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $course->title }}</h5>
                    <p>{{ $course->level }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="text-white" aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="text-white" aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
        <span class="sr-only">Next</span>
    </a>
</div>
