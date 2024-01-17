<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @auth
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('logout')}}">logout</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            List Table
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('student.index')}}">Students List</a></li>
            <li><a class="dropdown-item" href="{{route('teacher.index')}}">Teachers List</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('register')}}">Signup</a>
        </li>
        @endauth
      </ul>

      
      <span class="navbar-text">@auth{{auth()->user()->name}}@endauth
      </span>
    </div>
  </div>
</nav>