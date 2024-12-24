<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="{{$meta_description->teks ?? ''}}" />
  <meta name="keywords" content="{{$meta_keywords->teks ?? ''}} " />
  <link href="{{ asset('img/'. $page_setting->ikon)}}" rel="icon" />
  <title>Administrator | Dashboard</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="{{asset('css/admin/simplebar.css')}}">
  <!-- Fonts CSS -->
  <link
    href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="{{ asset('css/admin/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}">
  <link rel="stylesheet" href="{{ asset('css/admin/dropzone.css')}}">
  <link rel="stylesheet" href="{{ asset('css/admin/uppy.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/admin/jquery.steps.css')}}">
  <link rel="stylesheet" href="{{ asset('css/admin/jquery.timepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('css/admin/quill.snow.css')}}">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="{{ asset('css/admin/daterangepicker.css')}}">
  <!-- App CSS -->
  <link rel="stylesheet" href="{{ asset('css/admin/app-light.css')}}" id="lightTheme" disabled>
  <link rel="stylesheet" href="{{ asset('css/admin/app-dark.css')}}" id="darkTheme">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <script src="https://kit.fontawesome.com/48f517d746.js" crossorigin="anonymous"></script>

</head>

<body class="vertical  dark  ">
  <div class="wrapper">
    <nav class="topnav navbar navbar-light">
      <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
      </button>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
            <i class="fe fe-sun fe-16"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
              @if(auth()->user()->foto)
              <img src="{{ asset('img/profile/' . auth()->user()->foto) }}" alt="User Image" class="img-circle" style="width: 30px; height: 30px; border-radius: 50%;">
              @else
              <span class="material-symbols-outlined">
                admin_panel_settings
              </span>
              @endif
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('admin.profile')}}">Akun Saya</a>
            <a class="dropdown-item" href="{{ route('logout')}}">Logout</a>
          </div>
        </li>
      </ul>
    </nav>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
      <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x">
          <span class="sr-only">
          </span>
        </i>
      </a>
      <nav class="vertnav navbar navbar-light">
        <div class="w-100 mb-4 d-flex align-items-center">
          <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/pertinas-logo.jpg') }}" alt="icon" width="50" height="50" class="me-3">
                <div class="text-container" id="brand-container">
                    <span id="brand-text" class="d-block">PERTINASIA</span>
                    @if(Auth::check() && Auth::user()->online)
                        <span class="badge bg-success online-badge">Online</span>
                    @endif
                </div>
            </a>
        </div>
        @if(session('full-access'))
            <!-- Tampilkan seluruh menu secara penuh untuk user tipe 99 -->
            @include('admin.partials.full-aside')
        @else
            <!-- Tampilkan menu berdasarkan data dari user role -->
            @include('admin.partials.role-aside')
        @endif
      </nav>
    </aside>
    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Control Panel</h2>
              </div>
              <div class="col-auto">
                <form class="form-inline" method="GET" action="{{ route('admin.dashboard') }}">
                  <div class="form-group d-none d-lg-inline">
                    <label for="reportrange" class="sr-only">Date Ranges</label>
                    <div id="reportrange" class="px-2 py-2 text-muted">
                      <span class="small"></span>
                    </div>
                    <input type="hidden" name="start_date" id="start_date">
                    <input type="hidden" name="end_date" id="end_date">
                  </div>
                  <div class="form-group">
                      <button type="button" class="btn btn-sm" id="refresh-button">
                          <span class="fe fe-refresh-ccw fe-16 text-muted"></span>
                      </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mb-2 align-items-center">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Statistik Kunjungan</strong>
                </div>
                <div class="card-body">
                  <div class="row mt-1 align-items-center">
                    <div class="col-12 col-lg-4 text-center py-4">
                      <p class="mb-1 small text-muted">User Online</p>
                      <span class="h3">{{ $userOnline }}</span><br />
                    </div>
                    <div class="col-6 col-lg-2 text-center py-4">
                      <p class="mb-1 small text-muted">Hari ini</p>
                      <span class="h3">{{ $pengunjungHariIni }}</span><br />
                    </div>
                    <div class="col-6 col-lg-2 text-center py-4 mb-2">
                      <p class="mb-1 small text-muted">Kemarin</p>
                      <span class="h3">{{ $pengunjungKemarin }}</span><br />
                    </div>
                    <div class="col-6 col-lg-2 text-center py-4">
                      <p class="mb-1 small text-muted">Minggu ini</p>
                      <span class="h3">{{ $pengunjungMingguIni }}</span><br />
                    </div>
                    <div class="col-6 col-lg-2 text-center py-4">
                      <p class="mb-1 small text-muted">Bulan ini</p>
                      <span class="h3">{{ $pengunjungBulanIni }}</span><br />
                    </div>
                  </div>
                  <div class="chartbox mr-4">
                    <div id="areaChart"></div>
                  </div>
                </div> <!-- .card-body -->
              </div> <!-- .card -->
            </div>

            <div class="row">
              <!-- Recent Activity -->
              <div class="col-md-12 col-lg-6 mb-4">
                <div class="card timeline shadow">
                  <div class="card-header">
                    <strong class="card-title">Detail Kunjungan</strong>
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="float-right small text-muted">
                      <select name="tahun" onchange="this.form.submit()">
                        @foreach ($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ $tahunDipilih == $tahun ? 'selected' : '' }}>
                          {{ $tahun }}
                        </option>
                        @endforeach
                      </select>
                    </form>
                  </div>
                  <div class="card-body my-n2">
                    <table class="table table-striped table-hover table-borderless">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Bulan</th>
                          <th>Kunjungan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($pengunjungPerBulan as $bulan => $jumlah)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <th scope="col">{{ \Carbon\Carbon::create()->month($bulan)->format('F') }}</th>
                          <td>{{ number_format($jumlah) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="2" class="text-center"><strong>Total Kunjungan</strong></td>
                          <td><strong>{{ number_format($totalKunjungan) }}</strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div> <!-- / .card -->
              </div> <!-- / .col-md-6 -->
              <!-- Striped rows -->
              <div class="col-md-12 col-lg-6">
                <div class="card shadow">
                  <div class="card-header">
                    <strong class="card-title">News Report</strong>
                    <a class="float-right small text-muted" href="{{Route ('admin.berita')}}">View all</a>
                  </div>
                  <div class="card-body my-n2">
                    <table class="table table-striped table-hover table-borderless">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Judul</th>
                          <th>Views</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($berita as $b)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <th scope="col">{{$b->judul}}</th>
                          <td>{{$b->viewer}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> <!-- Striped rows -->
            </div> <!-- .row-->
          </div> <!-- .col-12 -->
        </div> <!-- .row -->
      </div> <!-- .container-fluid -->
    </main> <!-- main -->
  </div>
  <script type="text/javascript">
    var date = {!!json_encode($date) !!};
    var viewer = {!!json_encode($viewer) !!};
  </script>
  <script src="{{asset('js/admin/jquery.min.js')}}"></script>
  <script src="{{asset('js/admin/popper.min.js')}}"></script>
  <script src="{{asset('js/admin/moment.min.js')}}"></script>
  <script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/admin/simplebar.min.js')}}"></script>
  <script src="{{asset('js/admin/daterangepicker.js')}}"></script>
  <script src="{{asset('js/admin/jquery.stickOnScroll.js')}}"></script>
  <script src="{{asset('js/admin/tinycolor-min.js')}}"></script>
  <script src="{{asset('js/admin/config.js')}}"></script>
  <script src="{{asset('js/admin/d3.min.js')}}"></script>
  <script src="{{asset('js/admin/topojson.min.js')}}"></script>
  <script src="{{asset('js/admin/datamaps.all.min.js')}}"></script>
  <script src="{{asset('js/admin/datamaps-zoomto.js')}}"></script>
  <script src="{{asset('js/admin/datamaps.custom.js')}}"></script>
  <script src="{{asset('js/admin/Chart.min.js')}}"></script>
  <script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
  </script>
  <script src="{{asset('js/admin/gauge.min.js')}}"></script>
  <script src="{{asset('js/admin/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('js/admin/apexcharts.min.js')}}"></script>
  <script src="{{asset('js/admin/apexcharts.custom.js')}}"></script>
  <script src="{{asset('js/admin/jquery.mask.min.js')}}"></script>
  <script src="{{asset('js/admin/select2.min.js')}}"></script>
  <script src="{{asset('js/admin/jquery.steps.min.js')}}"></script>
  <script src="{{asset('js/admin/jquery.validate.min.js')}}"></script>
  <script src="{{asset('js/admin/jquery.timepicker.js')}}"></script>
  <script src="{{asset('js/admin/dropzone.min.js')}}"></script>
  <script src="{{asset('js/admin/uppy.min.js')}}"></script>
  <script src="{{asset('js/admin/quill.min.js')}}"></script>
  <script>
    $('.select2').select2({
      theme: 'bootstrap4',
    });
    $('.select2-multi').select2({
      multiple: true,
      theme: 'bootstrap4',
    });
    $('.drgpicker').daterangepicker({
      singleDatePicker: true,
      timePicker: false,
      showDropdowns: true,
      locale: {
        format: 'MM/DD/YYYY'
      }
    });
    $('.time-input').timepicker({
      'scrollDefault': 'now',
      'zindex': '9999' /* fix modal open */
    });
    /** date range picker */
    if ($('.datetimes').length) {
      $('.datetimes').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
          format: 'M/DD hh:mm A'
        }
      });
    }

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#start_date').val(start.format('YYYY-MM-DD'));
      $('#end_date').val(end.format('YYYY-MM-DD'));

      $.ajax({
        url: "{{ route('admin.dashboard') }}",
        method: 'GET',
        data: {
          start_date: start.format('YYYY-MM-DD'),
          end_date: end.format('YYYY-MM-DD')
        },
        success: function(response) {
          console.log('Data dari server:', response);

          // Cek apakah ada data yang diterima
          if (response.date.length === 0 || response.viewer.length === 0) {
            // Jika data kosong, perbarui grafik untuk tidak menampilkan apa pun
            if (areachart) {
              areachart.updateSeries([{
                name: 'Pengunjung',
                data: [] // Grafik kosong
              }]);

              areachart.updateOptions({
                xaxis: {
                  categories: [] // Kosongkan kategori x-axis
                },
                annotations: {
                  position: 'back',
                  yaxis: [{
                    y: 0, // Posisi Y untuk label
                    label: {
                      text: 'Tidak ada data tersedia',
                      style: {
                        color: '#FF0000', // Warna teks 
                        fontSize: '18px'
                      }
                    }
                  }]
                }
              });
            }
          } else {
            // Jika ada data, update grafik dengan data dari server
            if (areachart) {
              areachart.updateSeries([{
                name: 'Pengunjung',
                data: response.viewer
              }]);

              areachart.updateOptions({
                xaxis: {
                  categories: response.date
                },
                annotations: {
                  // Kosongkan anotasi jika ada data
                  position: 'back',
                  yaxis: []
                }
              });
            }
          }
        },
        error: function(error) {
          console.log('Error fetching data:', error);
        }
      });
    }

    $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
      }
    }, cb);

    cb(start, end);

    document.getElementById('refresh-button').addEventListener('click', function() {
        window.location.href = "{{ route('admin.dashboard') }}";
    });

    document.addEventListener('DOMContentLoaded', function() {
        var toggleButton = document.querySelector('.collapseSidebar');
        var brandContainer = document.getElementById('brand-container');

        toggleButton.addEventListener('click', function() {
            brandContainer.classList.toggle('hide-text');
        });
    });
    // editor
  </script>
  <script src="{{asset('js/admin/apps.js')}}"></script>

</body>

</html>