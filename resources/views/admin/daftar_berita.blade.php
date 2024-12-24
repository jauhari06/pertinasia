
@extends('admin.layouts.admin')
@php
use App\Helpers\Helper;
@endphp

@section('content')
<section class="content-header">
    <h1>
        Daftar Berita
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Berita Eksternal</li>
    </ol>
</section>

<section class="content">
    <!-- Main row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="box-title col-md-12">
						<div class="col-md-2">
							<div class="btn-group">
								<a href="{{ route('admin.berita.create') }}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah">
									<i class="fa fa-plus"></i>
								</a>
							</div>
                            <div class="btn-group">
								<button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh">
									<i class="fa fa-refresh"></i>
								</button>
							</div>
                        </div>

                        <form method="get" action="{{ route('admin.berita') }}">
							<div class="col-md-4">
								<select class="form-control" name="id_kategori" onchange="this.form.submit()">
									<option value="">--Tampil Semua--</option>
									@foreach ($kategori as $k)
									<option value="{{  $k->id }}" {{ request('id_kategori') ==  $k->id ? 'selected' : '' }}>
										{{ $k->nama_kategori }}
									</option>
									@endforeach
								</select>
							</div>
						</form>
					</div>

                    <div class="box-tools" style="width: 150px;">
                        <form method="get" action="{{ route('berita.search') }}">
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
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th style=" width: 14%; ">Tgl. & Jam Posting</th>
                            <th style=" width: 5%; ">Dibaca</th>
                            <th style=" width: 5%; ">Status</th>
                            <th style=" width: 10%; ">Action</th>
                        </tr>

                        @foreach($berita as $b)
                        <tr>
                            <td>{{$b->judul}}</td>
                            <td>{!! Helper::limitHtml($b->deskripsi, 200) !!}</td>
                            <td>{{ $b->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                            <td>{{$b->tgl_jam}}</td>
                            <td>{{$b->viewer}}</td>
                            <td> @if($b->aktif == 1)
                                <span class="badge badge-success">Aktif</span>
                                @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('berita.edit', $b->id)}}" title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Edit" class="btn btn-xs tooltips btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="{{ route('berita.destroy', $b->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button title="" data-placement="top" data-toggle="tooltip" type="submit" data-original-title="Hapus" class="btn btn-xs tooltips btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                                <form action="{{ route('berita.toggleAktif', $b->id) }}" method="POST" style="display:inline;">
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
                        Menampilkan {{$berita->count()}} data dari total {{$berita->total()}} data
                    </div>
                    <div class="col-md-6 text-right">
                        {{ $berita->links('vendor.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection