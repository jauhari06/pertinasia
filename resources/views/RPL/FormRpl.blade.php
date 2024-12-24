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
                <h3>FORMULIR APLIKASI RPL TIPE A (Form 2)</h3>
                <div class="card">
                    <form class="form-card" action="{{ route('cetak-form') }}" method="POST">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Program studi<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="program_studi" name="program_studi" class="flex-grow-1"
                                    placeholder="Masukkan Program Studi" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3 mb-2">Jenjang<span
                                        class="text-danger">*</span></label>
                                <select id="jenjang" name="jenjang" class="form-control">
                                    <option value="Sarjana">Sarjana</option>
                                    <option value="Pasca Sarjana">Pasca Sarjana</option>
                                </select>
                            </div>
                        </div>
                        <p style="text-align: left;">Nama Perguruan Tinggi : Universitas Narotama Surabaya.</p>
                        <h5 class="mb-4" style="text-align: left;">Bagian 1: Rincian Data Calon Mahasiswa</h5>
                        <p style="text-align: left;">Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan saudara
                            pada saat ini.</p>
                        <h6 class="mb-4" style="text-align: left;">a. Data Pribadi</h6>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Nama lengkap<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    placeholder="Masukkan Nama lengkap" onblur="validate(1)">
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
                                <label class="form-control-label px-3">Jenis kelamin<span
                                        class="text-danger">*</span></label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Status<span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-control">
                                    <option value="Menikah">Menikah</option>
                                    <option value="Lajang">Lajang</option>
                                    <option value="Pernah menikah">Pernah menikah</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <label class="form-control-label px-3">Kebangsaan<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="kebangsaan" name="kebangsaan" placeholder="Masukkan Kebangsaan anda"
                                    onblur="validate(6)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <label class="form-control-label px-3">Alamat Rumah<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="alamat_rumah" name="alamat_rumah" placeholder="Masukkan Alamat Rumah anda"
                                    onblur="validate(6)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Kode Pos<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="kode_pos" name="kode_pos" placeholder="Masukkan Kode Pos anda" onblur="validate(3)">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">No. Telepon/HP<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="no_telepon" name="no_telepon" placeholder="Masukkan No. Telepon/HP anda"
                                    onblur="validate(4)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Email<span class="text-danger">*</span></label>
                                <input type="text" id="email" name="email" placeholder="Masukkan Email anda" onblur="validate(5)">
                            </div>
                        </div>
                        <h6 class="mb-4" style="text-align: left;">b. Data Pendidikan </h6>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Pendidikan Terakhir<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir"
                                    placeholder="Masukkan Pendidikan Terakhir anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Nama Perguruan Tinggi/Sekolah<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama_perguruan_tinggi" name="nama_perguruan_tinggi"
                                    placeholder="Masukkan Nama Perguruan Tinggi/Sekolah anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Program Studi<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="program_studi_pendidikan" name="program_studi_pendidikan"
                                    placeholder="Masukkan Program Studi anda" onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Tahun lulus<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="tahun_lulus" name="tahun_lulus"
                                    placeholder="Masukkan Tahun lulus anda" onblur="validate(1)">
                            </div>
                        </div>
                        <h5 class="mb-4" style="text-align: left;">Bagian 2: Daftar Mata Kuliah</h5>
                        <p style="text-align: left;">
                            Daftar Mata Kuliah pada Program Studi yang diajukan untuk memperoleh pengakuan berdasarkan
                            kompetensi
                            yang sudah saudara peroleh dari pendidikan formal sebelumnya (melalui Transfer sks), dan
                            dari pendidikan
                            nonformal, informal atau pengalaman kerja (melalui asesmen untuk Perolehan sks), dengan cara
                            memberi tanda pada pilihan Ya atau Tidak.
                        </p>
                        <table class="table table-bordered" id="mataKuliahTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>KODE MK</th>
                                    <th>NAMA MATAKULIAH</th>
                                    <th>SKS</th>
                                    <th>Mengajukan RPL</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody >
                                <!-- Baris pertama -->
                                <tr>
                                    <td><input type="text" name="mata_kuliah[0][kode_mk]" class="form-control"
                                            placeholder="Masukkan KODE MK"></td>
                                    <td><input type="text" name="mata_kuliah[0][nama_matkul]" class="form-control"
                                            placeholder="Masukkan Nama Matakuliah"></td>
                                    <td><input type="number" name="mata_kuliah[0][sks]" class="form-control"
                                            placeholder="Masukkan SKS"></td>
                                    <td>
                                        <select name="mata_kuliah[0][rpl]" class="form-control">
                                            <option value="iya">Iya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="mata_kuliah[0][keterangan]" class="form-control">
                                            <option value="transfer_sks">Transfer SKS</option>
                                            <option value="perolehan_sks">Perolehan SKS</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBaris('mataKuliahTable')">Tambah Baris</button>
                        </div>
                        <p class="mt-4" style="text-align: left;">
                            Bersama ini saya mengajukan permohonan untuk dapat mengikuti Rekognisi Pembelajaran Lampau
                            (RPL)
                            dan dengan ini saya menyatakan bahwa:
                        </p>
                        <p style="text-align: left;">1. Semua informasi yang saya tuliskan adalah sepenuhnya benar dan
                            saya
                            bertanggung-jawab atas seluruh data dalam formulir ini, dan apabila dikemudian hari ternyata
                            informasi yang saya sampaikan tersebut adalah tidak benar, maka saya bersedia menerima
                            sangsi
                            sesuai dengan ketentuan yang berlaku;</p>
                        <p style="text-align: left;">2. Saya memberikan ijin kepada pihak pengelola program RPL, untuk
                            melakukan pemeriksaan kebenaran informasi yang saya berikan dalam formulir aplikasi ini
                            kepada
                            seluruh pihak yang terkait dengan jenjang akademik sebelumnya dan kepada perusahaan tempat
                            saya
                            bekerja sebelumnya dan atau saat ini saya bekerja;</p>
                        <p style="text-align: left;">3. Saya akan mengikuti proses asesmen sesuai dengan jadwal/waktu
                            yang
                            ditetapkan oleh Perguruan Tinggi.</p>
                        <!-- Tombol Simpan dan Cetak -->
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
    <script src="{{ asset('js/Rpl-val.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#tanggal_lahir').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false, // Tambahkan ini untuk mencegah pengisian otomatis
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            // Kosongkan nilai input setelah inisialisasi
            $('#tanggal_lahir').val('');
        });
    </script>
</body>

</html>