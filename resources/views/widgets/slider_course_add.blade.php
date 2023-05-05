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
          <a href="/course/lesson/create" class="list-group-item list-group-item-action px-5 py-3 ripple @if($active == 2) active @endif">
            <i class="fas fa-solid fa-person-chalkboard fa-fw me-3 "></i><span>Adauga lectie</span>
          </a>
          <a href="/test/create" class="list-group-item list-group-item-action py-3 px-5 ripple @if($active == 3) active @endif"
            ><i class="fas fa-duotone fa-check-double fa-fw me-3"></i><span>Adauga Test</span></a
          >

          <a href="/forum/create" class="list-group-item list-group-item-action px-5 py-3 ripple @if($active == 4) active @endif"
            ><i class="fas fa-users fa-fw me-3"></i><span>Creaza o discoutie</span></a
          >
        </div>
    </div>
</div>
