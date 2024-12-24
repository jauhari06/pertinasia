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
                <div class="w-100 mb-4 d-end">
                    <P class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                        <img src="{{ asset('img/pertinas-logo.jpg')}}" alt="icon" width="50" height="50">
                        PERTINASIA
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
                                <h2 class="h5 page-title">Album</h2>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <strong class="card-title">{{$album->nama_album}}</strong>
                                    </div>
                                    <div class="card-body my-n2 table-responsive">
                                        <table class="table table-striped table-hover table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th class="text-right">Status</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($foto as $f)
                                                <tr>
                                                    <td> @if (file_exists(public_path('img/galeri_foto/' . $f->foto)))
                                                        <img src="{{ asset('img/galeri_foto/' . $f->foto) }}" style="width: 200px; height: auto;">
                                                        @else
                                                        <span>Foto tidak tersedia</span> {{-- Menampilkan pesan jika foto tidak ada --}}
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        @if ($f->aktif == 1)
                                                        <span class="badge badge-success">Aktif</span>
                                                        @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="#" class="text-mute mr-2" data-toggle="modal" data-target="#editModal-{{ $f->id }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <a href="#" class="text-mute mr-2" data-toggle="modal" data-target="#deleteModal-{{ $f->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="#" class="text-mute mr-2" data-toggle="modal" data-target="#activateModal-{{ $f->id }}">
                                                            <i class="fa-solid fa-check"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
        </main> <!-- main -->
    </div>
    <!-- Modal Edit -->
    @foreach ($foto as $f)
    <div class="modal fade" id="editModal-{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('foto.update', $f->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <small class="form-text text-muted">Foto saat ini:</small>
                            <img src="{{ asset('img/galeri_foto/' . $f->foto) }}" style="width: 100px; height: auto;">
                            <input type="file" class="form-control-file" id="foto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $f->keterangan}}">
                        </div>
                        <div class="form-group">
                            <label for="id_album">Pilih Kategori Album</label>
                            <select class="form-control" id="id_album" name="id_album" required>
                                <option value="" disabled selected>Pilih Kategori Album</option>
                                @foreach ($allAlbum as $aA)
                                <option value="{{ $aA->id }}" {{ $aA->id == $f->id_album ? 'selected' : '' }}>
                                    {{ $aA->nama_album }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($foto as $f)
    <div class="modal fade" id="deleteModal-{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus Foto {{ $f->foto }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('foto.delete', $f->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Activate -->
    @foreach ($foto as $f)
    <div class="modal fade" id="activateModal-{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Aktifkan Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($f -> aktif != 1)
                    Apakah anda ingin mengaktifkan Foto {{ $f->foto }}?
                    @else ($f -> aktif == 1)
                    Apakah anda ingin menonaktifkan Album {{ $f->foto }}?
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('foto.toggleAktif', $f->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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
    <script src="{{asset('js/admin/apps.js')}}"></script>
</body>

</html>