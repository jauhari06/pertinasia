@php
use App\Helpers\Helper;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>
    {{ $title->teks ?? 'PERTINASIA' }}
  </title>
  <meta name="description" content="{{$meta_description->teks ?? ''}}" />
  <meta name="keywords" content="{{$meta_keywords->teks ?? ''}} " />

  <!-- Favicons -->
  <link href="{{ asset('img/'. $page_setting->ikon)}}" rel="icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/48f517d746.js" crossorigin="anonymous"></script>

    <!-- Vendor CSS Files -->
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
<link href="{{ asset('vendor/aos/aos.css')}}" rel="stylesheet" />
<link href="{{ asset('vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />


<!-- Main CSS File -->
<link href="{{ asset('css/main.css')}}" rel="stylesheet" />
  </head>

  <body class="category-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
      <div
        class="container position-relative d-flex align-items-center justify-content-between"
      >
        <a
          href="{{ route('home') }}"
          class="logo d-flex align-items-center me-auto me-xl-0"
        >
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="{{ asset('img/'. $page_setting->ikon)}}" alt="" />
          <h1 class="sitename">{{ $page_setting->page_name}}</h1>
        </a>


        <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{route('home')}}">Home</a></li>
          <li class="dropdown">
            <a href="#"><span>Tentang Kami</span>
              <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul class="dropdown-menu">
              <li>
                <a
                  href="{{ route('about')}}"
                  class="active">Risalah</a>
              </li>
              <li>
                <a
                  href="{{ $rensta_url}}"
                  target="_blank"
                  class="active">Rensta & Renop</a>
              </li>
              <li>
                <a
                  href="{{ $hukum_url }}"
                  target="_blank"
                  class="active">Legalitas</a>
              </li>
            </ul>
          </li>
          <li><a href="{{route('pendaftaran')}}">Pendaftaran</a></li>
          <li><a href="{{route('berita')}}">Berita</a></li>
          <li><a href="{{route('media')}}">Media</a></li>
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      </div>
    </header>

    <main class="main">
      <!-- Page Title -->
      <div class="page-title position-relative">
        <div class="container d-lg-flex justify-content-between align-items-center">
          <h1 class="mb-2 mb-lg-0">Berita</h1>
        </div>
      </div>
      <!-- End Page Title -->
    
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <!-- Berita Section -->
            <section id="blog-posts" class="blog-posts section">
              <div class="container">
                <div class="row gy-4">
                  @foreach($berita as $item)
                  <div class="col-lg-12">
                    <article class="position-relative h-100">
                      <div class="post-img position-relative overflow-hidden">
                        @if($item->image_url)
                        <img src="{{ $item->image_url }}" class="img-fluid" alt="" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}';">
                        @endif
                        <span class="post-date">{{ \Carbon\Carbon::parse($item->tgl_jam_publish)->format('F d, Y') }}</span>
                      </div>
    
                      <div class="post-content d-flex flex-column">
                        <h3 class="post-title">{{ $item->judul }}</h3>
    
                        <div class="meta d-flex align-items-center">
                          <div class="d-flex align-items-center">
                          <i class="fa-solid fa-eye"></i>
                            <span class="ps-2">Dilihat: {{$item->viewer}}x</span>
                          </div>
                          <span class="px-3 text-black-50">/</span>
                          <div class="d-flex align-items-center">
                            <i class="bi bi-folder2"></i>
                            <span class="ps-2">{{ $item->id_kategori }}</span>
                          </div>
                        </div>
    
                        <p>{!! Helper::limitHtml( $item->deskripsi, 100)!!}</p>
    
                        <hr />
    
                        <a href="{{ url('berita/'.$item->id) }}" class="readmore stretched-link">
                          <span>Lihat Selengkapnya</span>
                          <i class="bi bi-arrow-right"></i>
                        </a>
                      </div>
                    </article>
                  </div>
                  @endforeach
                </div>
    
                <!-- Blog Pagination Section -->
                <div class="d-flex justify-content-center mt-4 blog-pagination">
                  {{ $berita->links('pagination::bootstrap-4') }}
                </div>
              </div>
            </section>
          </div>
    
          <div class="col-lg-4">
            <div class="widgets-container">
              <!-- Search Widget -->
              <div class="search-widget  mb-4">
                {{-- <h3 class="widget-title">Search</h3> --}}
                <form action="{{ route('berita') }}" method="GET">
                  <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request()->input('search') }}">
                  <button type="submit" class="btn btn-primary mt-2" title="Search">
                    <i class="bi bi-search"></i>
                  </button>
                </form>
              </div>
              <!-- End Search Widget -->
    
              <!-- Recent Posts Widget -->
              <div class="recent-posts-widget widget-item">
                <h3 class="widget-title">Berita Trending</h3>
    
                @foreach($trendingPosts as $post)
                <div class="post-item d-flex mb-3">
                  @if($post->image_url)
                  <img src="{{ $post->image_url }}" alt="" class="flex-shrink-0 me-3" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}';">
                  @endif
                  <div>
                    <h4><a href="{{ url('berita/'.$post->id) }}">{{ $post->judul }}</a></h4>
                    <time datetime="{{ $post->tgl_jam_publish }}">{{ \Carbon\Carbon::parse($post->tgl_jam_publish)->format('M d, Y') }}</time>
                  </div>
                </div>
                @endforeach
              </div>
              <!-- End Recent Posts Widget -->
            </div>
          </div>
        </div>
      </div>
    </main>    

    <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-6 col-md-4 footer-about">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <span class="sitename">{{$page_setting->page_name}}</span>
          </a>
          <div class="footer-contact pt-2">
            <p>PERTINASIA (Perkumpulan Perguruan Tinggi Nasionalis Indonesia)
              adalah organisasi yang menghimpun perguruan tinggi, terutama swasta,
              dengan visi memperkuat nilai-nilai Pancasila dalam pendidikan
              tinggi. Didirikan pada 2018, PERTINASIA bertujuan meningkatkan
              kualitas pendidikan dan peran perguruan tinggi dalam memajukan ilmu
              pengetahuan dan teknologi untuk kemajuan bangsa. Organisasi ini
              berperan sebagai mitra strategis Badan Pembinaan Ideologi Pancasila
              (BPIP) dan terbuka bagi perguruan tinggi yang sevisi, baik swasta
              maupun negeri, untuk menjaga keutuhan NKRI, kebhinekaan, dan
              pelaksanaan UUD 1945.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 footer-links">
          <h3>Links</h3>
          <ul>
            @foreach ($link as $quickLink) 
            <li><a href="{{ $quickLink->link }}"> {{ $quickLink->nama_link }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid copyright text-center mt-4">
      <p>
        {!! $footer !!}
      </p>
    </div>
  </footer>

    <!-- Scroll Top -->
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>