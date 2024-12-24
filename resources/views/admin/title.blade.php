@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Title
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Title</li>
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
									<a href="{{ route('admin.create-title')}}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah">
										<i class="fa fa-plus"></i>
									</a>
								</div>
								<div class="btn-group">
									<button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
								</div>
							</div>
						</div>

						<div class="box-tools" style="width: 150px;">
						<form method="get" action="{{ route('title.search') }}">
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
								<th>Title</th>
								<th style=" width: 10%; ">Status</th>
								<th style=" width: 10%; ">Action</th>
							</tr>
							@foreach($settingtitle as $t)
							<tr>
								<td>{!! \App\Helpers\Helper::highlight( $t->teks, $key ?? '' )!!}</td>
								<td> @if ($t -> aktif == 1)
									<span class="badge badge-success">Aktif</span>
									@else
									<span class="badge badge-danger">Tidak Aktif</span>
									@endif
								</td>
								<td>
									<a href="{{ route('edit.title', $t->id)}}" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Edit" class="btn btn-xs tooltips btn-info"><i class="fa fa-pencil"></i> </a>
									<form action="{{ route('title.delete', $t->id) }}" method="POST" style="display:inline;">
										@csrf
										@method('DELETE')
										<button title="" data-placement="top" data-toggle="tooltip" type="submit" data-original-title="Hapus" class="btn btn-xs tooltips btn-danger">
											<i class="fa fa-trash-o"></i>
										 </button>
									</form>
									<form action="{{ route('title.toggleAktif', $t->id) }}" method="POST" style="display:inline;">
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
							Menampilkan {{$settingtitle->count()}} data dari total {{$settingtitle->total()}} data
						</div>
						<div class="col-md-6 text-right">
							{{ $settingtitle->links('vendor.pagination') }}
						</div>
					</div>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
</section>
<!-- right col -->
@endsection