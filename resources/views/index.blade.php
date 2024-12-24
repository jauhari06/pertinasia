<!DOCTYPE html>
<html lang="en">
@php
use App\Helpers\Helper;
@endphp
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

  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

  <!-- Add lightbox2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('vendor/aos/aos.css')}}" rel="stylesheet" />
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />

  <!-- Main CSS File  untuk galery-->
  <link href="{{ asset('css/main.css')}}" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
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
    <div class="slider-page">
      <section id="slider" class="slider section">
          <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper init-swiper">
                  <div class="swiper-wrapper">
                      @foreach($banners as $banner)
                      <div class="swiper-slide">
                          <img src="{{ asset('img/banner/' . $banner->banner) }}" alt="Banner Image" class="slider-image">
                      </div>
                      @endforeach
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-pagination"></div>
              </div>
          </div>
      </section>
  </div>
    <!-- /Slider Section -->

    <!-- Berita Section -->
    <div class="container section-title" data-aos="fade-up">
      <div class="section-title-container d-flex align-items-center justify-content-between">
        <h2>Portal Berita</h2>
      </div>
    </div>

    <section class="news-portal" data-aos="fade-up">
      <div class="container berita-section">
        <div class="berita-terkini">
          <h5 class="berita-terkini-title">Berita Terkini</h5>
          <div class="latest-news">
            @if($berita->isNotEmpty())
            @foreach($berita as $b)
            <a href="{{ route('detail-berita', ['id' => $b->id]) }}">
              <img src="{{ $b->image_url }}" alt="{{ $b->judul }}" class="image-fluid" onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}';">
              <div class="news-info">
                <h3>{{ $b->judul }}</h3>
                <div class="date">{{ \Carbon\Carbon::parse($b->tgl_jam_publish)->format('d F Y') }}</div>
                <p>{!! Helper::limitHtml($b->deskripsi, 150) !!}</p>
              </div>
            </a>
            @endforeach
            @else
            <p>Tidak Ada Berita terkini.</p>
            @endif
          </div>
        </div>

        <div class="berita-trending">
          <h5 class="berita-trending-title">Berita Trending</h5>
          <div class="trending-news">
            @foreach($beritaPopuler as $bPopuler)
            <a href="{{ route('detail-berita', ['id'=> $bPopuler->id])}}">
              <div class="trending-news-item">
                <img src="{{ $bPopuler->image_url ? $bPopuler->image_url : 'asset/img/no-image.jpg' }}"
                  alt="Trending News {{ $loop->index + 1 }}">
                <div class="news-info">
                  <h4>{{ $bPopuler->judul }}</h4>
                  <div class="date">{{ \Carbon\Carbon::parse($bPopuler->tgl_jam_publish)->format(' d F Y ') }}</div>
                  <p>{!! Helper::limitHtml($bPopuler->deskripsi, 50) !!}</p>
                </div>
              </div>
            </a>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Lihat Selengkapnya -->
      <div class="lihat-selengkapnya-container">
        <div class="container section-title" data-aos="fade-up">
          <p><a href="{{route('berita')}}">Lihat Selengkapnya</a></p>
        </div>
      </div>
    </section>


   <!-- Media Section -->
<section id="galeri" class="projects-section galeri-section galeri-img section" data-aos="fade-up">
  <div class="container section-title" data-aos="fade-up">
      <div class="section-title-container d-flex align-items-center justify-content-between">
          <h2>Media</h2>
      </div>
      <div class="carousel-container">
          <h3>Foto</h3>
          <div class="your-class">
              @foreach ($foto as $f)
              <div>
                  <a href="{{ asset('img/galeri_foto/' . $f->foto) }}" class="popup-link">
                      <img src="{{ asset('img/galeri_foto/' . $f->foto) }}" alt="Foto">
                  </a>
              </div>
              @endforeach
          </div>
      </div>

      <!-- Video Title and Carousel -->
      <div class="carousel-container">
          <h3>Video</h3>
          <div class="your-class">
              @foreach ($video as $v)
              <div class="video-class">
                  <div class="video-thumbnail" onclick="loadVideo(this)" data-src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($v->link, 'v=') }}">
                      <!-- Gambar thumbnail video dari YouTube -->
                      <img src="https://img.youtube.com/vi/{{ \Illuminate\Support\Str::after($v->link, 'v=') }}/hqdefault.jpg" 
                           alt="{{ $v->judul }}" style="cursor: pointer; width: 100%; height: auto;">
                      <!-- Tombol play overlay -->
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </div>
</section>
  </main>

  <!-- Footer -->
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
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Slick Carousel Dependencies -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- Magnific Popup JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Slick Carousel Initialization -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Slick Carousel initialization
      $('.your-class').slick({
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1
      });

      // Magnific Popup initialization for image zoom
      $('.your-class').magnificPopup({
        delegate: 'a.popup-link', // Child item selector, clicking on it will trigger the popup
        type: 'image',
        gallery: {
          enabled: true // Enable gallery mode to navigate between images
        },
        zoom: {
          enabled: true, // Enable zoom-in feature
          duration: 300 // Duration of the zoom animation
        }
      });
    });
  </script>
  <script>
      function loadVideo(el) {
    // Buat elemen iframe baru
    const iframe = document.createElement('iframe');
    iframe.width = "560";
    iframe.height = "315";
    iframe.src = el.getAttribute('data-src');  // Ambil URL dari atribut data-src
    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
    iframe.setAttribute('allowfullscreen', 'true');

    // Ganti placeholder dengan iframe
    el.replaceWith(iframe);
}
  </script>

  <!-- Main JS File -->
  <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>