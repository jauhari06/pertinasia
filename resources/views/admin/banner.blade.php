@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        Banner
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banner</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <div class="col-md-12">
                                <div class="btn-group">
                                    <a href="{{route('admin.create-banner')}}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-tools" style="width: 150px;">
                            <form method="get" action="{{ route('banner.search') }}">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="key" class="form-control pull-right" placeholder="Search" value="{{ old('key', $key ?? '') }}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Gambar</th>
                                <th style=" width: 10%; ">Urut</th>
                                <th style=" width: 10%; ">Status</th>
                                <th style=" width: 10%; ">Action</th>
                            </tr>
                            @foreach($banner as $b)
                            <tr>
                                <td> <img src="{{ asset('img/banner/' . $b->banner) }}" style="width: 400px; height: 200px;"><br />
                                    <strong>Filename:</strong> {{ $b->banner }}
                                </td>
                                <td>
                                    {{ $b->urut }}
                                </td>
                                <td> @if($b->aktif == 1)
                                    <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('banner.update', $b->id) }}" class="btn btn-xs btn-info" title="Edit" data-placement="top" data-toggle="tooltip">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('banner.delete', $b->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" title="Hapus" data-placement="top" data-toggle="tooltip">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('banner.toggleAktif', $b->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button title="" data-placement="top" data-toggle="tooltip" type="submit" data-original-title="Set. Aktif / Non Aktif" class="btn btn-xs tooltips btn-warning">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="col-md-6">
                            Menampilkan {{ $banner->count() }} data dari total {{ $banner->total() }} data
                        </div>
                        <div class="col-md-6 text-right">
                            {{ $banner->links('vendor.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection