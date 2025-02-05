<div class="sidebar">
  <nav class="mt-4">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('acara') }}" class="nav-link">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>Acara</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.tamu') }}" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>Tamu</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.narasumber') }}" class="nav-link">
          <i class="nav-icon fas fa-user-check"></i>
          <p>Narasumber</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.magang') }}" class="nav-link">
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
