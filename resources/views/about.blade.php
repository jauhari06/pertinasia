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
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link
        href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}"
        rel="stylesheet" />
    <link
        href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}"
        rel="stylesheet" />
    <link href="{{ asset('vendor/aos/aos.css')}}" rel="stylesheet" />
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ asset('css/main.css')}}" rel="stylesheet" />
</head>

<body class="contact-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div
            class="container position-relative d-flex align-items-center justify-content-between">
            <a
                href="{{ route('home') }}"
                class="logo d-flex align-items-center me-auto me-xl-0">
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

    <main class="main main-background">
        <!-- Page Title -->
        <div class="page-title">
            <div
                class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Tentang Kami</h1>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Contact Section -->
        <section
            id="contact"
            class="contact section main-background transparent-background">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <h2 class="bold-text">Risalah</h2>
                <div class="mb-4">
                    <div data-aos="fade-up" data-aos-delay="100">
                    @foreach ($risalah as $r)
                        <p>
                            {!! $r->deskripsi !!}
                        </p>
                        @endforeach
                    </div>

                    <!-- End risalah -->
                </div>
            </div>
        </section>
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
        class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>