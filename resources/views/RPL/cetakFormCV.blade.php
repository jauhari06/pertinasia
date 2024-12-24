<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Riwayat Hidup</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .section {
            margin-top: 20px;
        }

        .label {
            display: inline-block;
            width: 200px;
            /* Adjust the width as needed */
            margin-bottom: -5px;
            vertical-align: top;
        }

        .checkbox-group {
            display: inline-block;
            max-width: calc(100% - 300px);
            /* Pastikan tidak melebihi margin */
            vertical-align: top;
        }

        .checkbox-group-wrapper {
            display: flex;
            flex-wrap: wrap;
            /* Memastikan checkbox pindah ke baris baru jika terlalu panjang */
            gap: 10px;
            /* Memberikan jarak antar elemen checkbox */
            align-items: center;
            /* Vertikal rata tengah */
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 5px;
            /* Jarak antara checkbox dan label */
        }


        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: start;
        }

        .text-center {
            text-align: center;
        }

        .align-middle {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('img/Header.png') }}" alt="Header" />
    </header>
    <h1>FORMULIR DAFTAR RIWAYAT HIDUP (CURRICULUM VITAE)</h1>

    <h3>IDENTITAS DIRI</h3>
    <p><span class="label">Nama </span> : {{ $data['nama'] }}</p>
    <p><span class="label">Tempat dan Tanggal Lahir</span> : {{ $data['tempat'] }} / {{ $data['tanggal_lahir'] }}</p>
    <p><span class="label">Jenis Kelamin </span> :
        @if($data['jenis_kelamin'] == 'Pria')
            Pria / <s>Wanita</s>
        @else
            <s>Pria</s> / Wanita
        @endif
        *)
    </p>
    <p><span class="label">Status Perkawinan </span> :
        @if($data['status'] == 'Menikah')
            Menikah / <s>Lajang</s> / <s>Pernah menikah</s>
        @elseif($data['status'] == 'Lajang')
            <s>Menikah</s> / Lajang / <s>Pernah menikah</s>
        @else
            <s>Menikah</s> / <s>Lajang</s> / Pernah menikah
        @endif
        *)
    </p>
    <p><span class="label">Agama </span> : {{ $data['agama'] }}</p>
    <p><span class="label">Institusi Tempat Bekerja </span> : {{ $data['institusi_tempat_bekerja'] }}</p>
    <p><span class="label">Jabatan </span> : {{ $data['jabatan'] }}</p>
    <p>
        <span class="label">Status Pekerjaan</span> :
        <span class="checkbox-group">
            <span class="checkbox-group-wrapper">
                <label class="checkbox-item">
                    <input type="checkbox" {{ $data['status_pekerjaan'] == 'pegawai_tetap' ? 'checked' : '' }}>
                    Pegawai Tetap
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" {{ $data['status_pekerjaan'] == 'pegawai_honorer' ? 'checked' : '' }}>
                    Pegawai Honorer
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" {{ $data['status_pekerjaan'] == 'pegawai_negeri_sipil' ? 'checked' : '' }}>
                    Pegawai Negeri Sipil
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" {{ $data['status_pekerjaan'] == 'lainnya' ? 'checked' : '' }}>
                    Lainnya....
                </label>
            </span>
        </span>
    </p>

    <p><span class="label">Alamat Tempat Bekerja </span> : {{ $data['alamat_tempat_bekerja'] }}</p>
    <p><span class="label">Telp./Faks </span> : {{ $data['telp_faks'] }}</p>
    <p><span class="label">Alamat Kantor </span> : {{ $data['alamat_kantor'] }}</p>
    <p><span class="label">Telp./Hp </span> : {{ $data['telp_hp'] }}</p>
    <p><span class="label">Alamat e-mail </span> : {{ $data['email'] }}</p>

    <div class="section">
        <h3>RIWAYAT PENDIDIKAN</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Nama Sekolah</th>
                    <th class="text-center align-middle">Tahun Lulus</th>
                    <th class="text-center align-middle">Jurusan/Program Studi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['pendidikan'] as $index => $pendidikan)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-center align-middle">{{ $pendidikan['sekolah'] }}</td>
                        <td class="text-center align-middle">{{ $pendidikan['tahun_lulus'] }}</td>
                        <td class="text-center align-middle">{{ $pendidikan['jurusan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p><em>Hanya diisi pendidikan menengah dan pendidikan tinggi</em></p>
    </div>

    <p style="page-break-after: always;"></p>

    <div class="section">
        <h3>PELATIHAN PROFESIONAL</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center align-middle" style="width: 70px;">Tahun</th>
                    <th class="text-center align-middle">Nama Pelatihan (dalam/luar negeri)
                        dan disebutkan uraian materinya</th>
                    <th class="text-center align-middle">Penyelenggara</th>
                    <th class="text-center align-middle">Jangka Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['pelatihan'] as $pelatihan)
                    <tr>
                        <td class="text-center align-middle">{{ $pelatihan['tahun'] }}</td>
                        <td class="text-center align-middle">{{ $pelatihan['nama'] }}</td>
                        <td class="text-center align-middle">{{ $pelatihan['penyelenggara'] }}</td>
                        <td class="text-center align-middle">{{ $pelatihan['jangka_waktu'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>KONFERENSI/SEMINAR/LOKAKARYA/SIMPOSIUM</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center align-middle" style="width: 70px;">Tahun</th>
                    <th class="text-center align-middle">Judul Seminar/lokakarya/simposium</th>
                    <th class="text-center align-middle">Penyelenggara</th>
                    <th class="text-center align-middle">Status keikutsertaan: Panitia/
                        peserta/pembicara</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['seminar'] as $seminar)
                    <tr>
                        <td class="text-center align-middle">{{ $seminar['tahun'] }}</td>
                        <td class="text-center align-middle">{{ $seminar['judul'] }}</td>
                        <td class="text-center align-middle">{{ $seminar['penyelenggara'] }}</td>
                        <td class="text-center align-middle">{{ $seminar['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>PENGHARGAAN/PIAGAM</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center align-middle">Tahun</th>
                    <th class="text-center align-middle">Bentuk Penghargaan</th>
                    <th class="text-center align-middle">Pemberi Penghargaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['penghargaan'] as $penghargaan)
                    <tr>
                        <td class="text-center align-middle">{{ $penghargaan['tahun'] }}</td>
                        <td class="text-center align-middle">{{ $penghargaan['bentuk'] }}</td>
                        <td class="text-center align-middle">{{ $penghargaan['pemberi'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>ORGANISASI PROFESI/ILMIAH</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center align-middle" style="width: 70px;">Tahun</th>
                    <th class="text-center align-middle">Jenis/Nama Organisasi</th>
                    <th class="text-center align-middle">Jabatan/jenjang keanggotaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['organisasi'] as $organisasi)
                    <tr>
                        <td class="text-center align-middle">{{ $organisasi['tahun'] }}</td>
                        <td class="text-center align-middle">{{ $organisasi['nama'] }}</td>
                        <td class="text-center align-middle">{{ $organisasi['jabatan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>DAFTAR RIWAYAT PEKERJAAN/PENGALAMAN KERJA</h3>
        <p>Pada bagian ini, diisi dengan pengalaman kerja yang anda miliki yang relevan dengan mata kuliah yang akan
            dinilai. Tulislah data pengalaman kerja saudara dimulai dari urutan paling akhir (terkini).</p>
        <table>
            <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Nama dan Alamat
                        Institusi/Perusahaan</th>
                    <th class="text-center align-middle">Periode Bekerja
                        (Tgl/bln/th)
                    </th>
                    <th class="text-center align-middle">Posisi/
                        Jabatan</th>
                    <th class="text-center align-middle">Uraian Tugas utama pada posisi pekerjaan tersebut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['pekerjaan'] as $index => $pekerjaan)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-center align-middle">{{ $pekerjaan['institusi'] }}</td>
                        <td class="text-center align-middle">{{ $pekerjaan['periode'] }}</td>
                        <td class="text-center align-middle">{{ $pekerjaan['posisi'] }}</td>
                        <td class="text-center align-middle">{{ $pekerjaan['tugas'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p><em> Apabila berpindah posisi/jabatan dalam pengalaman pekerjaan tersebut maka posisi/jabatan tersebut
                    harus
                    dituliskan dalam tabel meskipun perubahan posisi/jabatan tersebut masih dalam perusahaan yang
                    sama</em>
            </p>
        </div>
    </div>


    <div class="section">
        <p>Saya menyatakan bahwa semua keterangan dalam Daftar Riwayat Hidup (Curriculum Vitae) ini adalah sepenuhnya
            benar dan saya bertanggung-jawab atas seluruh data dalam formulir ini, dan apabila di kemudian hari ternyata
            informasi yang saya sampaikan tersebut tidak benar, maka saya bersedia menerima sanksi sesuai dengan
            ketentuan yang berlaku. Apabila terdapat kesalahan, saya bersedia mempertanggungjawabkannya.</p>
        <br><br>
    </div>

    <p style="text-align: right;"> Surabaya, {{ $data['tanggal_sekarang'] }}</p>
    <br><br>
    <div style="margin-top: 50px;">
        <table style="width: 100%; border: none; text-align: center;">
            <tr>
                <td style="width: 50%; text-align: center; border:none; padding-right:85px;">
                    <p>Mengetahui</p>
                    <p>Atasan Langsung</p>
                    <br><br><br><br><br>
                    <p>(__________________________)</p>
                </td>
                <td style="width: 50%; text-align: center; border:none; padding-left:35px;">
                    <p>Yang Menyatakan</p>
                    <br><br><br><br><br><br>
                    <p>(________________________)</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>