<nav class="navbar navbar-expand-lg modern-navbar">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" id="Logo_Name" href="{{ route('home') }}">📚 Estudify</a>
    
    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <!-- LEFT: Public Navigation -->
      <ul class="navbar-nav me-auto">
        <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        @guest
          <li><a class="nav-link" href="#features">Features</a></li>
          <li><a class="nav-link" href="#contact">Contact</a></li>
        @endguest
      </ul>
      
      <!-- MIDDLE: Role-Based Navigation -->
      @auth
        @if(auth()->user()->isSuperAdmin())
        <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                  📊 Dashboard
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('superadmin.dashboard') }}">Overview</a></li>
                  <li><hr></li>
                  <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'ADM']) }}">Admin</a></li>
                  <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'STU']) }}">Students</a></li>
                  <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'TCH']) }}">Teachers</a></li>
                  <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'PAR']) }}">Parents</a></li>
                  <li><a class="dropdown-item" href="">Classes</a></li>
                  <li><hr></li>
                  <li><a class="dropdown-item" href="">Reports</a></li>
                </ul>
              </li>
            </ul>
        @elseif(auth()->user()->isAdmin())
          <!-- Admin Menu -->
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                📊 Dashboard
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Overview</a></li>
                <li><hr></li>
                <li><a class="dropdown-item" href="">Students</a></li>
                <li><a class="dropdown-item" href="">Teachers</a></li>
                <li><a class="dropdown-item" href="">Classes</a></li>
                <li><hr></li>
                <li><a class="dropdown-item" href="">Reports</a></li>
              </ul>
            </li>
          </ul>
        @elseif(auth()->user()->isTeacher())
          <!-- Teacher Menu -->
          <ul class="navbar-nav">
            <li><a class="nav-link" href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            <li><a class="nav-link" href="{{ route('my-classes') }}">📚 Classes</a></li>
            <li><a class="nav-link" href="{{ route('grades') }}">📝 Grades</a></li>
          </ul>
        @endif
      @endauth
      
      <!-- RIGHT: Notifications & User Menu -->
      <ul class="navbar-nav ms-auto">
        
        @auth
          <!-- Notifications -->
          <li class="nav-item">
            <a class="nav-link position-relative" href="">
              🔔 Notifications
              <span class="badge badge-danger">3</span>
            </a>
          </li>
          
          <!-- Messages -->
          <li class="nav-item">
            <a class="nav-link position-relative" href="">
              💬 Messages
              <span class="badge badge-danger">5</span>
            </a>
          </li>
          
          <!-- Search (on desktop) -->
          <li class="nav-item d-none d-lg-block">
            <input type="search" class="nav-search" placeholder="Search...">
          </li>
          
          <!-- User Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle user-avatar" href="#" 
               data-bs-toggle="dropdown">
              👤 {{ auth()->user()->username }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="">Profile</a></li>
              <li><a class="dropdown-item" href="">Settings</a></li>
              <li><a class="dropdown-item" href="">Change Password</a></li>
              <li><hr></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <!-- Guest Auth Buttons -->
          <li><a class="nav-link btn-login" href="{{ route('login') }}">Login</a></li>
          <li><a class="nav-link btn-signup" href="{{ route('register') }}">Sign Up</a></li>
        @endauth
        
      </ul>
    </div>
  </div>
</nav>