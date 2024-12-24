<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULIR APLIKASI RPL TIPE A</title>
    <!-- Tambahkan link ke file CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link href="{{ asset('css/main-RPL.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">RPL TIPE A</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Form 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('form-eval') }}">Form 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('form-CV') }}">Form 3</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <h3>FORMULIR DAFTAR RIWAYAT HIDUP (CURRICULUM VITAE) (Form 5)</h3>
                <div class="card">
                    <h6 class="mb-4" style="text-align: left;">IDENTITAS DIRI</h6>
                    <p style="text-align: left;">Nama Perguruan Tinggi: Universitas Narotama Surabaya.</p>
                    <form class="form-card" action="{{ route('cetak-CV') }}" method="POST">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Nama<span class="text-danger"> *</span></label>
                                <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap Anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12">
                                <label class="form-control-label px-3">Tempat Tanggal Lahir<span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" id="tempat" name="tempat" placeholder="Masukkan Tempat Lahir"
                                            class="form-control mb-2">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value=""
                                            placeholder="Pilih Tanggal Lahir" class="form-control mb-2"
                                            onblur="validate(1)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Jenis kelamin<span class="text-danger">
                                    *</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Status<span class="text-danger"> *</span></label>
                            <select id="status" name="status" class="form-control">
                                <option value="Menikah">Menikah</option>
                                <option value="Lajang">Lajang</option>
                                <option value="Pernah menikah">Pernah menikah</option>
                            </select>
                        </div>
                    </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Agama <span class="text-danger"> *</span></label>
                                <input type="text" id="agama" name="agama" placeholder="Masukan Agama Anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Institusi Tempat Bekerja<span
                                        class="text-danger"> *</span></label>
                                <input type="text" id="institusi_tempat_bekerja" name="institusi_tempat_bekerja"
                                    placeholder="Masukan Institusi Tempat Bekerja Anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Jabatan<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="jabatan" name="jabatan" placeholder="Masukan Jabatan Anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Status Pekerjaan<span class="text-danger"> *</span></label>
                                <select id="status_pekerjaan" name="status_pekerjaan" class="form-control">
                                    <option value="" disabled selected>Pilih Status Pekerjaan</option>
                                    <option value="pegawai_tetap">Pegawai Tetap</option>
                                    <option value="pegawai_honorer">Pegawai Honorer</option>
                                    <option value="pegawai_negeri_sipil">Pegawai Negeri Sipil</option>
                                    <option value="lainnya">Lainnya....</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Alamat Tempat Bekerja<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="alamat_tempat_bekerja" name="alamat_tempat_bekerja"
                                    placeholder="Masukan Alamat Tempat Bekerja Anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Telp./Faks.<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="telp_faks" name="telp_faks"
                                    placeholder="Masukan Telp./Faks. Anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Alamat Kantor<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="alamat_kantor" name="alamat_kantor"
                                    placeholder="Masukan Alamat Kantor Anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Telp./HP<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="telp_hp" name="telp_hp" placeholder="Masukan Telp./HP Anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Alamat e-mail<span class="text-danger">
                                        *</span></label>    
                                <input type="text" id="email" name="email" placeholder="Masukan Alamat e-mail Anda"
                                    onblur="validate(1)">
                            </div>
                        </div>

                        <h6 class="mb-4" style="text-align: left;">RIWAYAT PENDIDIKAN </h6>
                        <table id="pendidikanTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Tahun Lulus</th>
                                    <th>Jurusan/Program Studi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="no">1</td>
                                    <td><input type="text" name="nama_sekolah[]" class="form-control"></td>
                                    <td><input type="text" name="tahun_lulus_pendidikan[]" class="form-control"></td>
                                    <td><input type="text" name="jurusan_program_studi[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary"
                                onclick="tambahBaris('pendidikanTable')">Tambah Baris</button>
                        </div>

                        <h6 class="mb-4" style="text-align: left;">PELATIHAN PROFESIONAL</h6>
                        <table id="pelatihanTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center align-middle" style="width: 90px;">Tahun</th>
                                    <th class="text-center align-middle" style="width: 300px;">Nama Pelatihan
                                        (dalam/luar negeri) dan
                                        disebutkan uraian materinya</th>
                                    <th class="text-center align-middle" style="width: 140px;">Penyelenggara</th>
                                    <th class="text-center align-middle">Jangka waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="tahun_pelatihan[]" class="form-control"></td>
                                    <td><input type="text" name="nama_pelatihan[]" class="form-control"></td>
                                    <td><input type="text" name="penyelenggara_pelatihan[]" class="form-control"></td>
                                    <td><input type="text" name="jangka_waktu_pelatihan[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBaris('pelatihanTable')">Tambah
                                Baris</button>
                        </div>

                        <h6 class="mb-4" style="text-align: left;">KONFERENSI/SEMINAR/LOKAKARYA/SIMPOSIUM </h6>
                        <table id="seminarTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center align-middle">Tahun</th>
                                    <th class="text-center align-middle">Judul Seminar/lokakarya/simposium</th>
                                    <th class="text-center align-middle">Penyelenggara</th>
                                    <th class="text-center align-middle">Status keikutsertaan: Panitia/
                                        peserta/pembicara</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="tahun_seminar[]" class="form-control"></td>
                                    <td><input type="text" name="judul_seminar[]" class="form-control"></td>
                                    <td><input type="text" name="penyelenggara_seminar[]" class="form-control"></td>
                                    <td><input type="text" name="status_keikutsertaan[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBaris('seminarTable')">Tambah
                                Baris</button>
                        </div>

                        <h6 class="mb-4" style="text-align: left;">PENGHARGAAN/PIAGAM</h6>
                        <table id="penghargaanTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 90px;">Tahun</th>
                                    <th>Bentuk Penghargaan</th>
                                    <th>Pemberi Penghargaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="tahun_penghargaan[]" class="form-control"></td>
                                    <td><input type="text" name="bentuk_penghargaan[]" class="form-control"></td>
                                    <td><input type="text" name="pemberi_penghargaan[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary"
                                onclick="tambahBaris('penghargaanTable')">Tambah Baris</button>
                        </div>

                        <h6 class="mb-4" style="text-align: left;">ORGANISASI PROFESI/ILMIAH</h6>
                        <table id="organisasiTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center align-middle" style="width: 90px;">Tahun</th>
                                    <th class="text-center align-middle">Jenis/ Nama Organisasi</th>
                                    <th class="text-center align-middle">Jabatan/jenjang keanggotaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="tahun_organisasi[]" class="form-control"></td>
                                    <td><input type="text" name="nama_organisasi[]" class="form-control"></td>
                                    <td><input type="text" name="jabatan_organisasi[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary"
                                onclick="tambahBaris('organisasiTable')">Tambah Baris</button>
                        </div>

                        <h6 class="mb-4" style="text-align: left;">DAFTAR RIWAYAT PEKERJAAN/PENGALAMAN KERJA</h6>
                        <p style="text-align: left;">Pada bagian ini, diisi dengan pengalaman kerja yang anda miliki
                            yang relevan dengan mata kuliah yang akan dinilai. Tulislah data pengalaman kerja saudara
                            dimulai dari urutan paling akhir (terkini).</p>
                        <table id="pekerjaanTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama dan Alamat
                                        Institusi/Perusahaan</th>
                                    <th class="text-center align-middle">Periode Bekerja
                                        (Tgl/bln/th)</th>
                                    <th class="text-center align-middle">Posisi/
                                        jabatan</th>
                                    <th class="text-center align-middle">Uraian Tugas utama pada posisi pekerjaan
                                        tersebut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="no">1</td>
                                    <td><input type="text" name="nama_alamat_institusi[]" class="form-control"></td>
                                    <td><input type="text" name="periode_bekerja[]" class="form-control"></td>
                                    <td><input type="text" name="posisi_jabatan[]" class="form-control"></td>
                                    <td><input type="text" name="uraian_tugas[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBaris('pekerjaanTable')">Tambah
                                Baris</button>
                        </div>

                        <p style="text-align: left;">Saya menyatakan bahwa semua keterangan dalam Daftar Riwayat Hidup
                            (Curriculum Vitae) ini adalah sepenuhnya benar dan saya bertanggung-jawab atasseluruh data
                            dalam formulir inidan apabila dikemudian hari ternyata informasi yang saya sampaikan
                            tersebut adalah tidak benar, maka saya bersedia menerima sangsi sesuai dengan ketentuan yang
                            berlaku dan apabila terdapat kesalahan, saya bersedia mempertanggungjawabkannya.</p>

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="submit" class="btn btn-secondary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan link ke file JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main-RPL.js') }}"></script>
    <script src="{{ asset('js/CV-val.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</body>

</html>