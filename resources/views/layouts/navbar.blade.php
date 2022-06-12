  <!--Navigation Bar-->
  <div class="container">
      <!--Navigation Bar Guest-->
      <nav class="row navbar navbar-expand-lg navbar-light bg-light nav-custom">
          <div class="container-fluid">
              <a class="navbar-brand" href="#"><img src="{{ url('/Frontend/Asset/Images/Logo-Gokarang.png') }}" />
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                  aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse d-lg-flex flex-row-reverse " id="navbarNavDropdown">
                  <ul class="navbar-nav ml-auto mr-3">
                      <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Beranda</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="{{ route('eksplor') }}">Eksplor
                              Wisata</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="{{ route('invest') }}">Pengembangan
                              Wisata</a>
                      </li>
                      @auth
                          <li class="nav-item dropdown bg-white">
                              <a class="nav-link dropdown-toggle" aria-current="page" href="#" id="user-logged-in"
                                  role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false">{{ auth()->user()->nama }}</a>
                              <ul class="dropdown-menu" aria-labelledby="user-logged-in">
                                  <li><a class="dropdown-item" href="{{ route('dashboard-user') }}">Dashboard Saya</a>
                                  </li>
                                  <li>
                                      <form action="/logout" method="POST">
                                          @csrf
                                          <button type="submit" class="dropdown-item">Logout</button>
                                      </form>
                                  </li>
                              </ul>
                          </li>
                          <div class="avatar">
                              <img src="/Asset/Images/Avatar.png" alt="" srcset="">
                          </div>
                      @endauth
                      @guest
                          <!-- Mobile button -->
                          <a href="{{ route('login') }}" class="form-inline d-sm-block d-lg-none">
                              <button class="btn btn-login text-white my-2 my-sm-0">
                                  Masuk/Daftar
                              </button>
                          </a>
                          <!-- Desktop Button -->
                          <a href="{{ route('login') }}" class="form-inline my-2 my-lg-0 d-none d-lg-block">
                              <button class="btn btn-login btn-navbar-right text-white my-2 my-sm-0 px-4">
                                  Masuk/Daftar
                              </button>
                          </a>
                      @endguest
                  </ul>
              </div>
          </div>
      </nav>

  </div>
