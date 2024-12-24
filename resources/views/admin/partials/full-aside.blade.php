<ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item">
            <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <i class="fa-solid fa-gauge fe-16"></i>
              <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
          <span>Main Navigation</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item dropdown">
            <a href="#berita" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-newspaper fe-16"></i>
              <span class="ml-3 item-text">Berita</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="berita">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ Route('admin.kategori-berita')}}"><span class="ml-1 item-text">Kategori Berita</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ Route('admin.berita') }}"><span class="ml-1 item-text">Daftar Berita</span></a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-camera fe-16"></i>
              <span class="ml-3 item-text">Media</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="media">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ Route('admin.album')}}"><span class="ml-1 item-text">Album
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.all-foto')}}"><span class="ml-1 item-text">Foto
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.video')}}"><span class="ml-1 item-text">Video
                  </span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-link fe-16"></i>
              <span class="ml-3 item-text">Link</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="link">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.kategori-link')}}"><span class="ml-1 item-text">Kategori Link</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.link')}}"><span class="ml-1 item-text">Daftar Link
                  </span></a>
              </li>
            </ul>
          </li>
          <li class="nav-item w-100">
            <a class="nav-link" href="{{ route('admin.pendaftaran')}}">
              <i class="fa-solid fa-book-bookmark fe-16"></i>
              <span class="ml-3 item-text">Pendaftaran</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="#about" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-flag fe-16"></i>
              <span class="ml-3 item-text">Tentang Kami</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="about">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.risalah')}}"><span class="ml-1 item-text">Risalah</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.renstra')}}"><span class="ml-1 item-text">Renstra & Renop</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('admin.legalitas')}}"><span
                    class="ml-1 item-text">Legalitas</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Sekretariat</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Pengurus</span></a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#setting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-gear fe-16"></i>
              <span class="ml-3 item-text">Setting</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="setting">
              <a class="nav-link pl-3" href="{{ route('admin.banner')}}"><span class="ml-1">Banner</span></a>
              <a class="nav-link pl-3" href="{{ route('admin.role')}}"><span class="ml-1">User Role</span></a>
              <a class="nav-link pl-3" href="{{ route('admin.usermanager')}}"><span class="ml-1">User Manager</span></a>
              <a class="nav-link pl-3" href="{{ route('admin.menu')}}"><span class="ml-1">Menu</span></a>
              <a class="nav-link pl-3" href="{{ route('admin.title')}}"><span class="ml-1">Title</span></a>
              <a class="nav-link pl-3" href="#"><span class="ml-1">Permalink</span></a>
              <a class="nav-link pl-3" href="{{ route('admin.limitberita')}}"><span class="ml-1">Limit Berita</span></a>
              <a class="nav-link pl-3" href="{{ route('admin.footer')}}"><span class="ml-1">Footer</span></a>
              <li class="nav-item dropdown">
                <a href="#meta-settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link pl-3">
                  <span class="ml-1">Meta</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="meta-settings">
                  <a class="nav-link pl-3" href="{{ route('admin.keyword')}}"><span class="ml-1">Keyword</span></a>
                  <a class="nav-link pl-3" href="{{ route('admin.description')}}"><span class="ml-1">Description</span></a>
                </ul>
              </li>
            </ul>
          </li>
        </ul>