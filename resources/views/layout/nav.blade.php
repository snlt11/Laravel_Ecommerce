<div class="container-fluid bg-white">
    <nav class="container navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('admin.home')}}">Laravel Ecommerce</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Jobs
                </a>
                <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('category.index')}}">Category</a></li>
                        <li><a class="dropdown-item" href="{{route('tags.index')}}">Tags</a></li>
                        <li><a class="dropdown-item" href="#">User Max</a></li>
                </ul>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                  </li>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</div>
