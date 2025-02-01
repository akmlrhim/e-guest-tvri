<div class="sidebar">

  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Alexander Pierce</a>
    </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('program') }}" class="nav-link">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>Acara</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>Tamu</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-user-check"></i>
          <p>Narasumber</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-school"></i>
          <p>Magang</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit(); ">
          <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
          <p class="text-danger">Logout</p>
        </a>
      </li>

      <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
        @csrf
      </form>
    </ul>
  </nav>
</div>
