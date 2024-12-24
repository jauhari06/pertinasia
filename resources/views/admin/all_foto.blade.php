@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
	<h1>
		Foto
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Foto</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Main row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="box-title col-md-12">
						<div class="col-md-2">
							<div class="btn-group">
								<a href="{{ route('admin.foto.create') }}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah">
									<i class="fa fa-plus"></i>
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh">
									<i class="fa fa-refresh"></i>
								</button>
							</div>
						</div>
						
						<form method="get" action="{{ route('admin.all-foto') }}">
							<div class="col-md-4">
								<select class="form-control" name="id_album" onchange="this.form.submit()">
									<option value="">-- Pilih Album --</option>
									@foreach ($allAlbum as $aA)
									<option value="{{ $aA->id }}" {{ request('id_album') == $aA->id ? 'selected' : '' }}>
										{{ $aA->nama_album }}
									</option>
									@endforeach
								</select>
							</div>
						</form>
					</div>

					<div class="box-tools" style="width: 150px;">
						<form method="get" action="{{ route('foto.search') }}">
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
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>Foto</th>
							<th>Album</th>
							<th style=" width: 10%; ">Status</th>
							<th style=" width: 10%; ">Action</th>
						</tr>

						@foreach($foto as $f)
						<tr>
							<td>
								<a href="{{asset ('img/galeri_foto/' . $f->foto)}}" target="_blank">
									<img src="{{ asset('img/galeri_foto/' . $f->foto) }}" alt="Foto" style="width: 300px; height: auto;">
									<br>
									{!! \App\Helpers\Helper::highlight( $f->keterangan , $key ?? '') !!}
								</a>
							</td>
							<td>{{ $f->album ? $f->album->nama_album : 'Tidak Ada Album' }}</td>
							<td> @if ($f->aktif == 1)
								<span class="badge badge-success">Aktif</span>
								@else
								<span class="badge badge-danger">Tidak Aktif</span>
								@endif
							</td>
							<td>
								<a href="{{ route('foto.edit', $f->id)}}" title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Edit" class="btn btn-xs tooltips btn-info">
									<i class="fa fa-pencil"></i>
								</a>
								<form action="{{ route('foto.delete', $f->id) }}" method="POST" style="display:inline;">
									@csrf
									@method('DELETE')
									<button title="" data-placement="top" data-toggle="tooltip" type="submit" data-original-title="Hapus" class="btn btn-xs tooltips btn-danger">
										<i class="fa fa-trash-o"></i>
									</button>
								</form>
								<form action="{{ route('foto.toggleAktif', $f->id) }}" method="POST" style="display:inline;">
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
				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<div class="col-md-6">
						Menampilkan {{$foto->count()}} data dari total {{$foto->total()}} data
					</div>
					<div class="col-md-6 text-right">
						{{ $foto->links('vendor.pagination') }}
					</div>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
</section>
<!-- right col -->
@endsection