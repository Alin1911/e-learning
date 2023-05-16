<div
    id="carouselExampleCaptions"
    class="carousel slide mb-5 shadow-sm"
    data-ride="carousel"
>
    <ol class="carousel-indicators">
        <li
            data-target="#carouselExampleCaptions"
            data-slide-to="0"
            class="active"
        ></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @foreach ($courses as $course)
            <div class="carousel-item @if($course->id == 1)active @endif">
                <img
                    class="d-block w-100"
                    src="{{ asset($course->image) }}"
                    alt="{{ $course->name }}"
                />
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $course->title }}</h5>
                    <p>{{ $course->level }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <a
        class="carousel-control-prev"
        href="#carouselExampleCaptions"
        role="button"
        data-slide="prev"
    >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a
        class="carousel-control-next"
        href="#carouselExampleCaptions"
        role="button"
        data-slide="next"
    >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
