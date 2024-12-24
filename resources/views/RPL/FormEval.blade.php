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
                <h3>FORMULIR EVALUASI DIRI (Form 3)</h3>
                <div class="card">
                    <p style="text-align: left;">Nama Perguruan Tinggi: Universitas Narotama Surabaya.</p>
                    <form class="form-card" action="{{ route('cetak-eval') }}" method="POST">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Program studi<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="prodi" name="prodi" placeholder="masukan program studi anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Nama Calon<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="nama_calon" name="nama_calon"
                                    placeholder="masukan nama lengkap anda" onblur="validate(1)">
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
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Alamat <span class="text-danger">
                                        *</span></label>
                                <input type="text" id="alamat" name="alamat" placeholder="masukan Alamat anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Nomor Telpon/HP<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="notlp" name="notlp" placeholder="masukan Nomor Telpon/HP anda"
                                    onblur="validate(1)">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Alamat E Mail<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="email" name="email" placeholder="masukan Alamat E Mail anda"
                                    onblur="validate(1)">
                            </div>
                        </div>

                        <h5 class="mb-4" style="text-align: left;">Nama Mata Kuliah : </h5>

                        <table id="mkTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>FED Nomor</th>
                                    <th>Kode MK</th>
                                    <th>Nama MK</th>
                                    <th>Sks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="FED_Nomor[]" class="form-control"></td>
                                    <td><input type="text" name="Kode_MK[]" class="form-control"></td>
                                    <td><input type="text" name="Nama_MK[]" class="form-control"></td>
                                    <td><input type="text" name="Sks[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBaris('mkTable')">Tambah
                                Baris</button>
                        </div>

                        <h5 class="mb-4" style="text-align: left;">Pengantar</h5>
                        <p style="text-align: left;">
                            Tujuan pengisian Formulir Evaluasi Diri ini adalah agar calon dapat secara mandiri menilai
                            tingkat profesiensi dari setiap kriteria unjuk kerja capaian pembelajaran mata kuliah atau
                            modul
                            pembelajaran dan menyampaikan bukti yang diperlukan untuk mendukung klaim tingkat
                            profesiensinya.
                        </p>
                        <p style="text-align: left;">
                            Isilah setiap kriteria unjuk kerja atau capaian pembelajaran pada halaman-halaman berikut
                            sesuai
                            dengan tingkat profesiansi yang saudara miliki. Saudara harus jujur dalam melakukan
                            penilaian
                            ini.
                        </p>
                        <p style="text-align: left;">
                            Catatan: Jika saudara merasa yakin dengan kemampuan yang saudara miliki atas pencapaian
                            profesiensi setiap kriteria unjuk kerja atau capaian pembelajaran yang dideskripsikan pada
                            halaman berikut, dimohon saudara dapat melampirkan bukti yang valid, autentik, terkini, dan
                            memadai untuk mendukung klaim saudara atas pencapaian profesiensi yang baik, dan/atau sangat
                            baik tersebut.
                        </p>
                        <p style="text-align: left;">
                            Identifikasi tingkat profesiensi pencapaian saudara dalam kriteria unjuk kerja atau capaian
                            pembelajaran dengan menggunakan jawaban berikut ini:
                        </p>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Profisiensi/Kemampuan</th>
                                    <th>Uraian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sangat baik</td>
                                    <td>
                                        <ul>
                                            <li>Saya melakukan tugas ini dengan sangat baik, atau</li>
                                            <li>Saya menguasai bahan kajian ini dengan sangat baik, atau</li>
                                            <li>Saya memiliki keterampilan ini, selalu digunakan dalam pekerjaan dengan
                                                tepat tanpa ada kesalahan</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Baik</td>
                                    <td>
                                        <ul>
                                            <li>Saya melakukan tugas ini dengan baik, atau</li>
                                            <li>Saya menguasai bahan kajian ini dengan baik, atau</li>
                                            <li>Saya memiliki keterampilan ini, dan kadang-kadang digunakan dalam
                                                pekerjaan
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tidak pernah</td>
                                    <td>
                                        <ul>
                                            <li>Saya tidak pernah melakukan tugas ini, atau</li>
                                            <li>Saya tidak menguasai bahan kajian ini, atau</li>
                                            <li>Saya tidak memiliki keterampilan ini</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align: left;">
                            Bukti yang dapat digunakan untuk mendukung klaim saudara atas pencapaian profesiensi yang
                            baik
                            dan atau sangat baik tersebut antara lain:
                        </p>

                        @php
                            $dokumen = [
                                "Ijazah dan/atau Transkrip Nilai dari Mata Kuliah yang pernah ditempuh di jenjang Pendidikan Tinggi sebelumnya (khusus untuk transfer sks)",
                                "Daftar Riwayat pekerjaan dengan rincian tugas yang dilakukan;",
                                "Sertifikat Kompetensi;",
                                "Sertifikat pengoperasian/lisensi yang sesuai dengan jabatan kerja dimiliki;",
                                "Foto pekerjaan yang pernah dilakukan dan deskripsi pekerjaan;",
                                "Buku harian;",
                                "Lembar tugas/lembar kerja ketika bekerja di perusahaan;",
                                "Dokumen analisis/perancangan (parsial atau lengkap) ketika bekerja di perusahaan;",
                                "Logbook;",
                                "Catatan pelatihan di lokasi tempat kerja;",
                                "Keanggotaan asosiasi profesi yang relevan;",
                                "Referensi / surat keterangan/ laporan verifikasi pihak ketiga dari pemberi kerja / supervisor;",
                                "Penghargaan dari industri;",
                                "Penilaian kinerja dari perusahaan;",
                                "Dokumen lain yang relevan;",
                            ];
                        @endphp

                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No. Dokumen</th>
                                    <th>Nama Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumen as $key => $value)
                                    <tr>
                                        <td>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <ul>
                                                {{ $value }}
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p style="text-align: left;">
                            Bukti (portofolio) untuk mendukung klaim calon atas pernyataan kriteria capaian pembelajaran
                            mata kuliah atau modul pembelajaran yang dilampirkan calon pada saat mengajukan lamaran akan
                            diverifikasi dan divalidasi oleh Asesor sesuai prinsip bukti, yaitu, sahih/valid (V),
                            autentik
                            (A), terkini (T) dan cukup/memadai (M), yaitu:
                        </p>
                        <ul style="text-align: left;">
                            <li>Valid/Sahih: ada hubungan yang jelas antara persyaratan bukti dari unit kompetensi/mata
                                kuliah yang akan dinilai dengan bukti yang menjadi dasar penilaian;</li>
                            <li>Autentik/Asli: dapat dibuktikan bahwa buktinya adalah karya calon sendiri.</li>
                            <li>Terkini: bukti menunjukkan pengetahuan dan keterampilan kandidat saat ini;</li>
                            <li>Memadai/Cukup: kriteria mengacu kepada kriteria unjuk kerja dan panduan bukti:
                                mendemonstrasikan kompetensi selama periode waktu tertentu; mengacu kepada semua dimensi
                                kompetensi; dan mendemonstrasikan kompetensi dalam konteks yang berbeda;</li>
                        </ul>


                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label class="form-control-label px-3">Mata Kuliah<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="mk" name="mk" placeholder="Formulir Evaluasi Diri Mata Kuliah:"
                                    onblur="validate(1)">
                            </div>
                        </div>


                        <p style="text-align: left;">Pada kolom pertama diisi Pernyataan Kemampuan Akhir yang
                            Diharapkan/Capaian Pembelajaran Mata Kuliah.</p>
                        <p style="text-align: left;">Pada mata kuliah ini, akan dipelajari konsep kimia penting termasuk
                            struktur atom, tata nama, stoikiometri, larutan cair, termodinamika, teori kuantum dan
                            ikatan
                            kimia. </p>

                        <table id="evalTable" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center align-middle" rowspan="2">Kemampuan Akhir Yang
                                        Diharapkan/Capaian
                                        Pembelajaran Mata Kuliah</th>
                                    <th class="text-center align-middle" rowspan="2">Profiesiensi pengetahuan dan
                                        keterampilan saat
                                        ini*</th>
                                    <th class="text-center align-middle" rowspan="2">Hasil evaluasi Asesor
                                        (diisi oleh Asesor)
                                    </th>
                                    <th colspan="2" class="text-center align-middle">Bukti yang disampaikan*</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Nomor Dokumen</th>
                                    <th class="text-center align-middle">Jenis dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="Pembelajaran[]" class="form-control"></td>
                                    <td>
                                        <select name="keterampilan[]" class="form-control">
                                            <option value="Sangat_baik">Sangat baik</option>
                                            <option value="Baik">Baik</option>
                                            <option value="tidak_pernah">Tidak pernah</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Capaian[]" class="form-control">
                                            <option value="V">V</option>
                                            <option value="A">A</option>
                                            <option value="T">T</option>
                                            <option value="M">M</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="FileBukti[]" class="form-control"></td>
                                    <td><input type="text" name="Keterangan[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBaris('evalTable')">Tambah
                                Baris</button>
                        </div>

                        <h5 class="mb-4" style="text-align: left;">Keterangan:</h5>
                        <ul style="text-align: left;">
                            <li>Kolom 1: Diisi oleh Program Studi, berupa Pernyataan Kemampuan Akhir yang
                                Diharapkan/Capaian
                                Pembelajaran Mata Kuliah.</li>
                            <li>Kolom 2: Diisi oleh Calon mahasiswa/pelamar RPL sesuai dengan tingkat profesiensi yang
                                dikuasainya atas pernyataan yang diuraikan di kolom 1.</li>
                            <li>Kolom 3: Diisi oleh Asesor setelah calon mengisi kolom 2 dan melampirkan BUKTI
                                (Portofolio)
                                yang disebutkan pada kolom 5 dan disusun nomor urutnya sesuai yang dinyatakan pada kolom
                                4.
                            </li>
                            <li>Kolom 4: Nomor urut BUKTI Portofolio sebagaimana jenis BUKTI yang diuraikan pada kolom 4
                            </li>
                            <li>Kolom 5: Jenis BUKTI portofolio. Bukti ini dapat digunakan secara berulang untuk
                                mendukung
                                klaim beberapa pernyataan yang diuraikan pada kolom 1. </li>
                        </ul>

                        <p style="text-align: left;">1. Semua informasi yang saya tuliskan adalah sepenuhnya benar dan
                            saya
                            bertanggung-jawab atas seluruh data dalam formulir ini dan apabila dikemudian hari ternyata
                            informasi yang saya sampaikan tersebut adalah tidak benar, maka saya bersedia menerima
                            sangsi
                            sesuai dengan ketentuan yang berlaku;</p>
                        <p style="text-align: left;">2. Saya memberikan ijin kepada pihak pengelola program RPL, untuk
                            melakukan pemeriksaan kebenaran informasi yang saya berikan dalam formulir evaluasi diri ini
                            kepada seluruh pihak yang terkait dengan data akademik sebelumnya dan kepada perusahaan
                            tempat
                            saya bekerja sebelumnya dan atau saat ini saya bekerja; dan</p>
                        <p style="text-align: left;">3. Saya bersedia untuk mengikuti asesmen lanjutan untuk membuktikan
                            kompetensi saya, sesuai waktu dan tempat/platform daring yang ditentukan oleh unit RPL.</p>

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
    <script src="{{ asset('js/eval-val.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>

</html>