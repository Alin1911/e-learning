@extends("layouts.app")

@section("content")

<div class="flowers-container">
    @for($i = 0; $i < 10; $i++)
        <div class="flower flower-{{$i+1}}"></div>
    @endfor
</div>
@endsection

<style>
.flowers-container {
    position: relative;
    height: 100vh;
}

.flower {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: flowerAnimation 5s infinite;
    width: 100px;
    height: 100px;
    background-color: red;
    border-radius: 50%;
}

@keyframes flowerAnimation {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    50% {
        transform: translate(-50%, -50%) rotate(180deg);
    }
    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}
</style>

<script>
// You can add any JavaScript code related to the animation here
const flowers = document.querySelectorAll('.flower');

flowers.forEach((flower, index) => {
    const delay = index * 0.2; // Adjust the delay as needed
    flower.style.animationDelay = `${delay}s`;
});
</script>