@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Limit Berita
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Limit Berita</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Main row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box">
					<div class="box-header">
						<div class="box-title">
							<div class="col-md-12">
								<div class="btn-group">
									<a href="{{ route('create.limitberita')}}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah">
										<i class="fa fa-plus"></i>
									</a>
								</div>
								<div class="btn-group">
									<button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>Limit Berita</th>
								<th style=" width: 10%; ">Status</th>
								<th style=" width: 10%; ">Action</th>
							</tr>
							@foreach($limitberita as $lB)
							<tr>
								<td>{{$lB->limit_berita}}</td>
								<td> @if ($lB -> aktif == 1)
									<span class="badge badge-success">Aktif</span>
									@else
									<span class="badge badge-danger">Tidak Aktif</span>
									@endif
								</td>
								<td>
									<a href="{{ route('edit.limitberita', $lB->id)}}" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Edit" class="btn btn-xs tooltips btn-info">
										<i class="fa fa-pencil"></i>
									</a>
									<form action="{{ route('limitberita.delete', $lB->id) }}" method="POST" style="display:inline;">
										@csrf
										@method('DELETE')
										<button title="" data-placement="top" data-toggle="tooltip" type="submit" data-original-title="Hapus" class="btn btn-xs tooltips btn-danger">
											<i class="fa fa-trash-o"></i>
										</button>
									</form>
									<form action="{{ route('limit.toggleAktif', $lB->id) }}" method="POST" style="display:inline;">
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
							Menampilkan {{$limitberita->count()}} data dari total {{$limitberita->total()}} data
						</div>
						{{ $limitberita->links('vendor.pagination') }}
					</div>

				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
</section>
<!-- right col -->
@endsection