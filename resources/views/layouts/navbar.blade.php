
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          @if (auth()->check()) 
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard">dashboard</a>
                </li>
          @endif
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Link</a></li>
              <li><a class="dropdown-item" href="#">Another link</a></li>
              <li><a class="dropdown-item" href="#">A third link</a></li>
            </ul>
          </li>
          <li class="nav-item">
            @if (auth()->check()) 
                <a class="nav-link" href="/logout">logout</a>
            @else
                <a class="nav-link" href="/login">login</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>
  