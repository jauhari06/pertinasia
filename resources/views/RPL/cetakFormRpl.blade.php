<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 2cm 1.25cm 1.25cm 1.5cm;
            position: relative;
            padding-top: 100px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
            z-index: 1;
        }

        header img {
            width: 100%;
            height: auto;
        }

        h1,
        h2 {
            margin: 0;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        p {
            font-size: 16px;
            margin-bottom: -10px;
        }

        .section {
            margin-bottom: 10px;
        }

        .label {
            display: inline-block;
            width: 250px;
            /* Adjust the width as needed */
            margin-bottom: -5px;
            margin-left: 25px;
        }
        .study {
            display: inline-block;
            width: 250px;
            /* Adjust the width as needed */
            margin-bottom: -5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('img/Header.png') }}" alt="Header" />
    </header>

    <h1>FORMULIR APLIKASI RPL TIPE A (Form 2)</h1>
    <p><span class="study">Program Studi</span> : {{ $data['program_studi'] }}</p>
    <p><span class="study">Jenjang</span> :
        @if($data['jenjang'] == 'Sarjana')
            Sarjana / <s>Pasca Sarjana</s>
        @else
            <s>Sarjana</s> / Pasca Sarjana
        @endif
    </p>
    <p><span class="study">Nama Perguruan Tinggi</span> : Universitas Narotama Surabaya</p>
    <br>

    <div class="section">
        <h3>Bagian 1: Rincian Data Calon Mahasiswa</h3>
        <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan saudara pada saat ini.
        </p>
        <h3>a. Data Pribadi</h3>
        <p><span class="label">Nama lengkap</span> : {{ $data['nama_lengkap'] }}</p>
        <p><span class="label">Tempat/Tgl. lahir</span> : {{ $data['tempat'] }} / {{ $data['tanggal_lahir'] }}</p>
        <p><span class="label">Jenis kelamin</span> :
            @if($data['jenis_kelamin'] == 'Pria')
                Pria / <s>Wanita</s>
            @else
                <s>Pria</s> / Wanita
            @endif
            *)
        </p>
        <p><span class="label">Status</span> :
            @if($data['status'] == 'Menikah')
                Menikah / <s>Lajang</s> / <s>Pernah menikah</s>
            @elseif($data['status'] == 'Lajang')
                <s>Menikah</s> / Lajang / <s>Pernah menikah</s>
            @else
                <s>Menikah</s> / <s>Lajang</s> / Pernah menikah
            @endif
            *)
        </p>
        <p><span class="label">Kebangsaan</span> : {{ $data['kebangsaan'] }}</p>
        <p><span class="label">Alamat rumah</span> : {{ $data['alamat_rumah'] }}</p>
        <p><span class="label">Kode Pos</span> : {{ $data['kode_pos'] }}</p>
        <p><span class="label">No. Telepon/HP</span> : {{ $data['no_telepon'] }}</p>
        <p><span class="label">E-mail</span> : {{ $data['email'] }}</p>
        <br>
        <p><em>*) Coret yang tidak perlu</em></p>
        <br>

        <h3>b. Data Pendidikan</h3>
        <p><span class="label">Pendidikan terakhir</span> : {{ $data['pendidikan_terakhir'] }}</p>
        <p><span class="label">Nama Perguruan Tinggi/Sekolah</span> : {{ $data['nama_perguruan_tinggi'] }}</p>
        <p><span class="label">Program Studi</span> : {{ $data['program_studi_pendidikan'] }}</p>
        <p><span class="label">Tahun lulus</span> : {{ $data['tahun_lulus'] }}</p>
        <br>
        <br>
        <br>
        <br>
        <p><em>Untuk lulusan SMA atau sederajat, kolom program studi dapat dikosongkan.</em></p>
        <p style="page-break-after: always;"></p>
    </div>

    <div class="section">
        <h3>Bagian 2: Daftar Mata Kuliah</h3>
        <p>Daftar Mata Kuliah pada Program Studi yang diajukan untuk memperoleh pengakuan berdasarkan kompetensi yang
            sudah saudara peroleh dari pendidikan formal sebelumnya (melalui Transfer sks), dan dari pendidikan
            nonformal, informal atau pengalaman kerja (melalui asesmen untuk Perolehan sks), dengan cara memberi tanda
            pada pilihan <strong>Ya</strong> atau <Strong>Tidak.</Strong></p>
        <br>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Matakuliah</th>
                    <th>SKS</th>
                    <th>Mengajukan RPL</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data['mata_kuliah']) && is_array($data['mata_kuliah']))
                    @foreach($data['mata_kuliah'] as $index => $mata_kuliah)
                        <tr>
                            <td>{{ (int) $index + 1 }}</td>
                            <td>{{ $mata_kuliah['kode_mk'] }}</td>
                            <td>{{ $mata_kuliah['nama_matkul'] }}</td>
                            <td>{{ $mata_kuliah['sks'] }}</td>
                            <td>{{ $mata_kuliah['rpl'] }}</td>
                            <td> @if($mata_kuliah['keterangan'] == 'transfer_sks')
                                Transfer SKS
                            @elseif($mata_kuliah['keterangan'] == 'perolehan_sks')
                                Perolehan SKS
                            @else
                                {{ $mata_kuliah['keterangan'] }}
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Tidak ada data mata kuliah.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <p>Bersama ini saya mengajukan permohonan untuk dapat mengikuti Rekognisi Pembelajaran Lampau (RPL) dan dengan
            ini saya menyatakan bahwa:
        </p>
        <p>
            1. Semua informasi yang saya tuliskan adalah sepenuhnya benar dan saya bertanggung-jawab atas seluruh data
            dalam formulir ini, dan apabila dikemudian hari ternyata informasi yang saya sampaikan tersebut adalah tidak
            benar, maka saya bersedia menerima sangsi sesuai dengan ketentuan yang berlaku;
        </p>
        <p>
            2. Saya memberikan ijin kepada pihak pengelola program RPL, untuk melakukan pemeriksaan kebenaran informasi
            yang saya berikan dalam formulir aplikasi ini kepada seluruh pihak yang terkait dengan jenjang akademik
            sebelumnya dan kepada perusahaan tempat saya bekerja sebelumnyadan atau saat ini saya bekerja; dan
        </p>
        <p>
            3. Saya akan mengikuti proses asesmen sesuai dengan jadwal/waktu yang ditetapkan oleh Perguruan Tinggi.
        </p>
    </div>

    <div class="signature">
        <p>Tempat/Tanggal: Surabaya, {{ $data['tanggal_sekarang'] }}</p>
        <p style="margin-right: 93px;">Tanda Tangan Pemohon:</p>
        <p style="margin-top: 100px;">(_______________________________)</p>
    </div>
</body>

</html>