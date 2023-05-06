<div class="sidebar">
    <div class="position-sticky">
        <div class="list-group list-group-flush">
          <a
            href="/course/create"
            class="list-group-item list-group-item-action py-3 px-5 ripple @if($active == 1) active @endif"
            aria-current="true"
          >
            <i class="fas fa-solid fa-book fa-fw me-3"></i><span>Adaugare curs</span>
          </a>
          <a href="/lesson/create" class="list-group-item list-group-item-action px-5 py-3 ripple @if($active == 2) active @endif">
            <i class="fas fa-solid fa-person-chalkboard fa-fw me-3 "></i><span>Adauga lectie</span>
          </a>
          <a href="/test/create" class="list-group-item list-group-item-action py-3 px-5 ripple @if($active == 3) active @endif"
            ><i class="fas fa-duotone fa-check-double fa-fw me-3"></i><span>Adauga Test</span></a
          >

          <a href="/forum/create" class="list-group-item list-group-item-action px-5 py-3 ripple @if($active == 4) active @endif"
            ><i class="fas fa-users fa-fw me-3"></i><span>Creaza o discoutie</span></a
          >
          @if(!@empty($courses))
              
          <div class="btn-group">
  <button type="button" class="btn btn-warning rounded-0 border dropdown-toggle py-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <h5>Cursurile tale</h5>
  </button>
  <div class="dropdown-menu p-0" style="width: 240px;">
    @foreach ($courses as $course)
    <a class="dropdown-item border-bottom py-2" href="/course/{{$course->id}}/edit">{{$course->title}}</a>
    @endforeach
  </div>
</div>
@endif
        </div>
    </div>
</div>
