<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Evaluasi Diri</title>
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

        .label {
            display: inline-block;
            width: 150px;
            /* Adjust the width as needed */
            margin-bottom: -5px;
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
            text-align: center;
            /* Pusatkan teks dalam th dan td */
        }

        td ul {
            text-align: left;
            /* Pastikan ul dalam td memiliki text-align start */
            list-style-type: disc;
            /* Menambahkan penanda bola kecil */
            padding-left: 20px;
            /* Menambahkan padding kiri untuk indentasi */
            margin: 0;
            /* Menghapus margin default pada ul */
        }

        td ul li {
            text-align: left;
            /* Pastikan li dalam ul dalam td memiliki text-align start */
        }

        .signature-section {
            margin-top: 50px;
            text-align: center;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: start;
        }

        .list-disc {
            margin-top: -5px;
            list-style-type: disc;
            padding-left: 20px;
        }

        .space {
            display: inline-block;
            width: 80px;
            /* Adjust the width as needed */
            vertical-align: top;
        }

        .para {
            display: inline-block;
            width: calc(100% - 160px);
            /* Adjust the width based on the label width */
            vertical-align: top;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('img/Header.png') }}" alt="Header" />
    </header>
    <h1>FORMULIR EVALUASI DIRI</h1>
    <p>Nama Perguruan Tinggi Univeristas Narotama Surabaya</p>
    <p><span class="label">Program Studi </span> : {{ $data['prodi'] }}</p>
    <p><span class="label">Nama Calon </span> : {{ $data['nama_calon'] }}</p>
    <p><span class="label">Tempat/Tgl Lahir </span> : {{ $data['tempat'] }} / {{ $data['tanggal_lahir'] }}</p>
    <p><span class="label">Alamat </span> : {{ $data['alamat'] }}</p>
    <p><span class="label">Nomor Telpon/HP </span> : {{ $data['notlp']}}</p>
    <p><span class="label">Alamat E-Mail </span> : {{ $data['email']}}</p>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>FED Nomor</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Sks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['mata_kuliah'] as $mk)
                <tr>
                    <td>{{ $mk['FED_Nomor'] }}</td>
                    <td>{{ $mk['Kode_MK'] }}</td>
                    <td>{{ $mk['Nama_MK'] }}</td>
                    <td>{{ $mk['Sks'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Pengantar</strong></p>
    <p>Tujuan pengisian Formulir Evaluasi Diri ini adalah agar calon dapat secara mandiri menilai tingkat profesiensi
        dari setiap kriteria unjuk kerja capaian pembelajaran mata kuliah atau modul pembelajaran dan menyampaikan bukti
        yang diperlukan untuk mendukung klaim tingkat profesiensinya.</p>
    <p>Isilah setiap kriteria unjuk kerja atau capaian pembelajaran pada halaman-halaman berikut sesuai dengan tingkat
        profesiansi yang saudara miliki. Saudara harus jujur dalam melakukan penilaian ini.</p>
    <p><strong>Catatan: </strong>Jika saudara merasa yakin dengan kemampuan yang saudara miliki atas pencapaian
        profesiensi setiap kriteria unjuk kerja atau capaian pembelajaran yang dideskripsikan pada halaman berikut,
        dimohon saudara dapat melampirkan bukti yang valid, autentik, terkini, dan memadai untuk mendukung klaim saudara
        atas pencapaian profesiensi yang baik, dan/atau sangat baik tersebut.</p>
    <br>
    <p>Identifikasi tingkat profesiensi pencapaian saudara dalam kriteria unjuk kerja atau capaian pembelajaran dengan
        menggunakan jawaban berikut ini:</p>
    <br><br><br><br>

    <div class="footer">
        <p style="font-size: 12px;"><em> Formulir Evaluasi Diri dibuat untuk setiap Mata Kuliah yang diberikan
                kesempatan untuk RPL, atau dapat
                dibuat dalam bentuk klaster Mata Kuliah</em></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Profisiensi/Kemampuan</th>
                <th>Uraian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sangat Baik</td>
                <td>
                    <ul>
                        <li>Saya melakukan tugas ini dengan sangat baik, atau</li>
                        <li>Saya menguasai bahan kajian ini dengan sangat baik, atau</li>
                        <li>Saya memiliki keterampilan ini, selalu digunakan dalam pekerjaan dengan tepat tanpa ada
                            kesalahan</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Baik</td>
                <td>
                    <ul>
                        <li>Saya melakukan tugas ini dengan baik, atau</li>
                        <li>Saya menguasai bahan kajian ini dengan baik, atau</li>
                        <li>Saya memiliki keterampilan ini, dan kadang-kadang digunakan dalam pekerjaan</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Tidak Pernah</td>
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

    <p><strong>Bukti</strong> yang dapat digunakan untuk mendukung klaim saudara atas pencapaian profesiensi yang baik
        dan atau sangat baik tersebut antara lain:</p>
    <table>
        <thead>
            <tr>
                <th>No. Dokumen</th>
                <th>Nama Dokumen</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td style="text-align:left;">Ijazah dan/atau Transkrip Nilai dari Mata Kuliah yang pernah ditempuh di
                    jenjang Pendidikan Tinggi
                    sebelumnya (khusus untuk transfer sks)</td>
            </tr>
            <tr>
                <td>02</td>
                <td style="text-align:left;">Daftar Riwayat pekerjaan dengan rincian tugas yang dilakukan;</td>
            </tr>
            <tr>
                <td>03</td>
                <td style="text-align:left;">Sertifikat Kompetensi;</td>
            </tr>
            <tr>
                <td>04</td>
                <td style="text-align:left;">Sertifikat pengoperasian/lisensi yang sesuai dengan jabatan kerja dimiliki;
                </td>
            </tr>
            <tr>
                <td>05</td>
                <td style="text-align:left;">Foto pekerjaan yang pernah dilakukan dan deskripsi pekerjaan;</td>
            </tr>
            <tr>
                <td>06</td>
                <td style="text-align:left;">Buku harian;</td>
            </tr>
            <tr>
                <td>07</td>
                <td style="text-align:left;">Lembar tugas/lembar kerja ketika bekerja di perusahaan;</td>
            </tr>
            <tr>
                <td>08</td>
                <td style="text-align:left;">Dokumen analisis/perancangan (parsial atau lengkap) ketika bekerja di
                    perusahaan;</td>
            </tr>
            <tr>
                <td>09</td>
                <td style="text-align:left;">Logbook;</td>
            </tr>
            <tr>
                <td>10</td>
                <td style="text-align:left;">Catatan pelatihan di lokasi tempat kerja;</td>
            </tr>
            <tr>
                <td>11</td>
                <td style="text-align:left;">Keanggotaan asosiasi profesi yang relevan;</td>
            </tr>
            <tr>
                <td>12</td>
                <td style="text-align:left;">Referensi / surat keterangan/ laporan verifikasi pihak ketiga dari pemberi
                    kerja / supervisor;</td>
            </tr>
            <tr>
                <td>13</td>
                <td style="text-align:left;">Penghargaan dari industri; dan</td>
            </tr>
            <tr>
                <td>14</td>
                <td style="text-align:left;">Penilaian kinerja dari perusahaan</td>
            </tr>
            <tr>
                <td>15</td>
                <td style="text-align:left;">Dokumen lain yang relevaan</td>
            </tr>
        </tbody>
    </table>

    <p><strong>Bukti</strong> (portofolio) untuk mendukung klaim calon atas pernyataan kriteria capaian pembelajaran
        mata kuliah atau modul pembelajaran yang dilampirkan calon pada saat mengajukan lamaran akan diverifikasi dan
        divalidasi oleh Asesor sesuai prinsip bukti, yaitu, sahih/valid <strong>(V)</strong>, autentik
        <strong>(A)</strong>, terkini <strong>(T)</strong> dan cukup/memadai
        <strong>(M)</strong>, yaitu:
    </p>
    <ul class="list-disc">
        <li>
            <p><strong>Valid/Sahih: </strong>ada hubungan yang jelas antara persyaratan bukti dari unit kompetensi/mata
                kuliah
                yang akan dinilai dengan bukti yang menjadi dasar penilaian;</p>
        </li>
        <li>
            <p><strong>Autentik/Asli: </strong>dapat dibuktikan bahwa buktinya adalah karya calon sendiri.</p>
        </li>
        <li>
            <p><strong>Terkini: </strong> bukti menunjukkan pengetahuan dan keterampilan kandidat saat ini;</p>
        </li>
        <li>
            <p><strong>Memadai/Cukup: </strong> kriteria mengacu kepada kriteria unjuk kerja dan panduan bukti:
                mendemonstrasikan kompetensi selama
                periode waktu tertentu; mengacu kepada semua dimensi kompetensi; dan mendemonstrasikan kompetensi dalam
                konteks
                yang
                berbeda;</p>
        </li>
    </ul>
    <br>

    <p>Formulir Evaluasi Diri Mata Kuliah: </p>
    <p>Pada kolom pertama diisi Pernyataan Kemampuan Akhir yang Diharapkan/Capaian Pembelajaran Mata Kuliah.
        Pada mata kuliah ini, akan dipelajari konsep kimia penting termasuk struktur atom, tata nama, stoikiometri,
        larutan cair, termodinamika, teori kuantum dan ikatan kimia.
    </p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kemampuan Akhir Yang Diharapkan/Capaian Pembelajaran Mata Kuliah</th>
                <th>Profiesiensi pengetahuan dan keterampilan saat ini</th>
                <th>Hasil evaluasi Asesor (diisi oleh Asesor)</th>
                <th>Nomor Dokumen</th>
                <th>Jenis dokumen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['evaluasi'] as $eval)
                <tr>
                    <td>{{ $eval['Pembelajaran'] }}</td>
                    <td> @if ($eval['keterampilan'] === 'Sangat_baik')
                        Sangat Baik
                    @elseif ($eval['keterampilan'] === 'Baik')
                        Baik
                    @elseif ($eval['keterampilan'] === 'tidak_pernah')
                        Tidak Pernah
                    @else
                        {{ $eval['keterampilan'] }} <!-- Default fallback jika ada nilai yang tidak dikenali -->
                    @endif
                    </td>
                    <td> @if ($eval['Capaian'] === 'V')
                        Valid
                    @elseif ($eval['Capaian'] === 'A')
                        Autentik
                    @elseif ($eval['Capaian'] === 'T')
                        Terkini
                    @elseif ($eval['Capaian'] === 'M')
                        Memadai
                    @else
                        {{ $eval['keterampilan'] }} <!-- Default fallback jika ada nilai yang tidak dikenali -->
                    @endif
                    </td>
                    <td>{{ $eval['FileBukti'] }}</td>
                    <td>{{ $eval['Keterangan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <p><strong>Keterangan: </strong></p>
    <p><span class="space">Kolom 1: </span><span class="para">Diisi oleh Program Studi, berupa Pernyataan Kemampuan
            Akhir yang
            Diharapkan/Capaian Pembelajaran Mata
            Kuliah.</span> </p>
    <p><span class="space">Kolom 2: </span><span class="para"> Diisi oleh Calon mahasiswa/pelamar RPL sesuai dengan
            tingkat profesiensi
            yang dikuasainya atas
            pernyataan yang diuraikan di kolom 1.</span></p>
    <p><span class="space">Kolom 3: </span><span class="para"> Diisi oleh Asesor setelah calon mengisi kolom 2 dan
            melampirkan BUKTI
            (Portofolio) yang disebutkan pada
            kolom 5 dan disusun nomor urutnya sesuai yang dinyatakan pada kolom 4.</span></p>
    <p><span class="space">Kolom 4: </span><span class="para"> Nomor urut BUKTI Portofolio sebagaimana jenis BUKTI yang
            diuraikan pada
            kolom 4</span></p>
    <p><span class="space">Kolom 5: </span><span class="para"> Jenis BUKTI portofolio. Bukti ini dapat digunakan secara
            berulang untuk
            mendukung klaim beberapa
            pernyataan yang diuraikan pada kolom 1.</span> </p>


    <div style="margin-top: 50px;">
        <table style="width: 100%; border: none; text-align: center;">
            <tr>
                <td style="width: 50%; text-align: center; border:none; padding-right:85px;">
                    <p>Mengetahui</p>
                    <p>Pengelola RPL/Kaprodi</p>
                    <br><br><br><br><br>
                    <p>(__________________________)</p>
                </td>
                <td style="width: 50%; text-align: center; border:none; padding-left:35px;">
                    <p>Surabaya, {{ $data['tanggal_sekarang'] }}</p>
                    <p>Pemohon RPL</p>
                    <br><br><br><br><br>
                    <p>(________________________)</p>
                </td>
            </tr>
        </table>
    </div>




</body>

</html>