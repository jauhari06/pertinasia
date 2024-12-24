@extends('admin.layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <div class="{{ auth()->user()->tipe == '99' ? 'col-md-6' : 'col-md-12' }}">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">News Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Judul</th>
                            <th style="width: 18%">Total View</th>
                        </tr>
                        @foreach ($berita as $b )
                        <tr>
                            <td style=" text-align: center">{{ $loop->iteration }}</td>
                            <td style=" padding-left: 5px; "> {{ $b->judul }}</td>
                            <td style=" text-align:center;"><span class="badge {{ $warna[$loop->index % count($warna)] }}">{{ $b->viewer }}</span></td>
                        </tr>
                        @endforeach

                    </table>
                </div>
                <br>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        @if (auth()->user()->tipe == '99')
        <div class="col-md-6">
            <!-- Application buttons -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Shortcut Buttons</h3>
                </div>
                <div class="box-body">
                    @foreach ($menu as $shortcut)
                    <a class="btn btn-app" href="{{ $shortcut->route !== '#' ? route($shortcut->route) : '#' }}">
                        <i class="fa {{ $shortcut->icon_class }}"></i> {{ $shortcut->nama_menu }}
                    </a>
                    @endforeach
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistik Kunjungan</h3>

                    <div class="box-tools pull-right">
                        <form method="get" action="{{ route('admin.dashboard')}}">
                            <div class="input-group input-group-sm" style="">
                                <select name="tahun" onchange=" submit();" class="form-control">
                                    @foreach ($tahunList as $tahun )
                                    <option value="{{ $tahun }}" {{ $tahunDipilih == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong></strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas height="300" width="703" id="salesChart" style="height: 300px; width: 703px;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Detail Kunjungan</strong>
                            </p>

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th>Bulan</th>
                                    <th style="width: 40px">Jumlah</th>
                                </tr>
                                @foreach ($pengunjungPerBulan as $bulan => $jumlah)
                                <tr>
                                    <td style=" padding: 0; text-align: center;">{{ $loop->iteration}}</td>
                                    <td style=" padding: 0; ">&nbsp;{{ \Carbon\Carbon::create()->month($bulan)->format('F') }}</td>
                                    <td style=" padding: 0; text-align: center;">{{ number_format($jumlah) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
                                    <td style="text-align: center;">{{ number_format($totalKunjungan) }}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $userOnline }}</h5>
                                <span class="description-text">USER ONLINE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $pengunjungHariIni }}</h5>
                                <span class="description-text">HARI INI</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $pengunjungKemarin }}</h5>
                                <span class="description-text">KEMARIN</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <h5 class="description-header">{{ $pengunjungBulanIni }}</h5>
                                <span class="description-text">BULAN INI</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

</section>
<!-- right col -->
@endsection