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
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('vendor/aos/aos.css')}}" rel="stylesheet" />
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css')}}" rel="stylesheet" />
  <link href="{{ asset('css/form.css')}}" rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="about-page">
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
    <!-- Page Title -->
    <div class="page-title">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Pendaftaran</h1>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Pendaftaran Section -->
    <section id="pendaftaran" class="pendaftaran section">
      <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0">
          <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
              <h2><strong>Form Pendaftaran</strong></h2>
              <p>
                Isi semua kolom formulir untuk melanjutkan ke langkah
                berikutnya
              </p>
              <div class="row">
                <div class="col-md-12 mx-0">
                  <form id="msform" name="registrationForm" action="{{ route('submit-form')}}" method="POST">
                    @csrf
                    <!-- progressbar -->
                    <ul id="progressbar">
                      <li class="active" id="pernyataan">
                        <strong>Pernyataan</strong>
                      </li>
                      <li id="personal"><strong>Formulir</strong></li>
                      <li id="submit"><strong>Selesai</strong></li>
                    </ul>

                    <!-- Step 1: Download Pernyataan -->
                    <fieldset>
                      <div class="form-card">
                        <h2 class="fs-title">Download File Pernyataan</h2>
                        <p>
                          Sebelum melanjutkan, silakan download file pernyataan di bawah ini:
                        </p>
                        <a href="{{ asset('Surat Kesediaan Menjadi Anggota PERTINASIA.pdf')}}" id="downloadStatement"
                          class="btn btn-primary" download target="_blank">Download Pernyataan</a>
                        <br /><br />
                        <p>
                          Setelah mendownload, klik "Next Step" untuk melanjutkan ke pengisian formulir.
                        </p>
                      </div>
                      <input type="button" name="next" id="nextButton" class="next action-button" value="Next Step"
                        disabled />
                    </fieldset>
                    <!-- Step 2: Formulir Pendaftaran -->
<fieldset>
  <div class="form-card">
    <h2 class="fs-title">Formulir Pendaftaran</h2>
    <div class="form-container">
      <!-- Bagian 1: Data Perguruan Tinggi -->
      <div class="form-section">
        <h3 class="fs-subtitle">Data Perguruan Tinggi</h3>
        
        @error('nama_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="nama_pts" placeholder="Nama Universitas" required />

        @error('alamat_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="alamat_pts" placeholder="Alamat Universitas" required />

        @error('kota_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="kota_pts" placeholder="Kota / Kab Universitas" required />

        @error('pos_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="pos_pts" placeholder="Kode Pos Universitas" required minlength="5" maxlength="5" />

        @error('thn_berdiri')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="thn_berdiri" placeholder="Tahun Berdiri" required />

        @error('jmlh_prodi')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="jmlh_prodi" placeholder="Jumlah Prodi" required />

        @error('email_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="email" name="email_pts" placeholder="Email Universitas" required />

        @error('tlp_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="tlp_pts" placeholder="Telepon Kantor" required minlength="6" maxlength="15" />

        @error('fax_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="fax_pts" placeholder="Fax Kantor" minlength="6" maxlength="15" />

        @error('web_pts')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="web_pts" placeholder="Website Universitas" required />
      </div>

      <!-- Bagian 2: Data Pribadi -->
      <div class="form-section">
        <h3 class="fs-subtitle">Data Pribadi</h3>

        @error('nama')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="nama" placeholder="Nama Lengkap (Dengan Gelar)" required />

        @error('tmp_lahir')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="tmp_lahir" placeholder="Tempat Lahir" required />

        @error('tgl_lahir')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" required />

        @error('masa_jbtn')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="masa_jbtn" placeholder="Masa Jabatan" required />

        @error('alamat')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="alamat" placeholder="Alamat Rumah" required />

        @error('kota')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="kota" placeholder="Kota / Kab Rumah" required />

        @error('kode_pos')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="kode_pos" placeholder="Kode Pos Rumah" required minlength="5" maxlength="5" />

        @error('tlpn')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="tlpn" placeholder="No Telepon" required minlength="6" maxlength="15" />

        @error('handphone')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="number" name="handphone" placeholder="No Handphone" required minlength="10" maxlength="15" />

        @error('email')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="email" name="email" placeholder="Email Pribadi" required />
      </div>
    </div>
  </div>
  <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
  <input type="button" name="submit" class="submit action-button" value="Submit" />
</fieldset>

                    <!-- Step 3: Selesai -->
                    <fieldset id="step3">
                      <div class="form-card">
                        <h2 class="fs-title text-center">
                          Formulir Berhasil Dikirim!
                        </h2>
                        <br /><br />
                        <div class="row justify-content-center">
                          <div class="col-3">
                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image" />
                          </div>
                        </div>
                        <br /><br />
                        <div class="row justify-content-center">
                          <div class="col-7 text-center">
                            <h5>
                              Terima kasih, Anda telah berhasil mendaftar.
                            </h5>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- /pendaftaran Section -->
  </main>

  <!-- ======= Footer ======= -->
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

  <script>
    var submitFormUrl = "{{ route('submit-form') }}"; // Mendefinisikan variabel global dengan route
  </script>
  <script src="{{ asset('js/form.js') }}"></script>
  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>