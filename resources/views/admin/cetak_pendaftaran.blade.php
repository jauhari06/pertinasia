<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cetak Pendaftaran {{ $pendaftaran->nama }}</title>
    <style type="text/css">
        td {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    @php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp
</head>
<body>
<table style="width: 100%;" align="center">
    <tr>
        <td align="center" valign="middle">
            <img src="{{ public_path('img/pertinas-favicon.png') }}" style="height: 100px; width: 107px;"><br>
            <span><strong style="font-size: 17px;">PERKUMPULAN PERGURUAN TINGGI NASIONAL INDONESIA</strong><br>
            <i style="font-size: 15px;">Website : http://www.pertinasia.org/</i></span>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; border-bottom: 3px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 100%; border-top: 1px solid black;">&nbsp;</td>
    </tr>
</table>
<table style="width: 100%;" align="left">
    <tr style="font-size: 16px;">
        <td style="width: 35%;font-weight: bold;">Nomor Seri Anggota</td>
        <td style="width: 2%;">: </td>
        <td style="width: 63%;border-bottom:1px dashed #000;">&nbsp;&nbsp;&nbsp;{{ $tahunnya }}-{{ str_pad($pendaftaran->id_seri, 3, '0', STR_PAD_LEFT) }}</td>
    </tr>
    <tr style="font-size: 16px;">
        <td style="width: 35%;font-weight: bold;padding-top: 10px;">Nama Perguruan Tinggi</td>
        <td style="width: 2%;padding-top: 10px;">: </td>
        <td style="width: 63%;border-bottom:1px dashed #000;padding-top: 10px;">&nbsp;&nbsp;&nbsp;{{ $pendaftaran->nama_pts }}</td>
    </tr>
    <tr style="font-size: 16px;">
        <td style="width: 35%;font-weight: bold;padding-top: 10px;">Alamat Perguruan Tinggi</td>
        <td style="width: 2%;padding-top: 10px;">: </td>
        <td style="width: 63%;border-bottom:1px dashed #000;padding-top: 10px;">&nbsp;&nbsp;&nbsp;{{ $pendaftaran->alamat_pts }}</td>
    </tr>
    <tr style="font-size: 16px;">
        <td style="width: 35%;font-weight: bold;padding-top: 10px;">Email Perguruan Tinggi</td>
        <td style="width: 2%;padding-top: 10px;">: </td>
        <td style="width: 63%;border-bottom:1px dashed #000;padding-top: 10px;">&nbsp;&nbsp;&nbsp;{{ $pendaftaran->email_pts }}</td>
    </tr>
    <tr style="font-size: 16px;">
        <td style="width: 35%;font-weight: bold;padding-top: 10px;">Telepon Perguruan Tinggi</td>
        <td style="width: 2%;padding-top: 10px;">: </td>
        <td style="width: 63%;border-bottom:1px dashed #000;padding-top: 10px;">&nbsp;&nbsp;&nbsp;{{ $pendaftaran->tlp_pts }}</td>
    </tr>
</table>
<table style="width: 100%;">
    <tr style="font-size: 16px;">
        <td style="width: 40%;" rowspan="2"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($pendaftaran->nama_pts)) !!} " style="margin-top: 40px; margin-left: 50px;" /></td>
        <td style="width: 60%;" align="center">Surabaya, {{ $tgl_sekarang }}</td>
    </tr>
    <tr style="font-size: 16px;">
        <td style="width: 60%;" align="center"><img src="{{ public_path('img/footerttd.jpeg') }}" style="width: 80%;"></td>
    </tr>
</table>
</body>
</html>