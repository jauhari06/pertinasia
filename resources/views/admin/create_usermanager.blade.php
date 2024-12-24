@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
	<!-- <h1>
          Setting > Usermanager
      </h1> -->
	<h1>
		Usermanager
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Usermanager</li>
	</ol>
	<!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usermanager</li>
      </ol>-->
</section>

<!-- Main content -->
<section class="content">
	<!-- Main row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Data</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form class="form-horizontal" action="{{ route('admin.add-usermanager')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="box-body">
						<div class="form-group">
							<label for="nama" class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="nama">
							</div>
						</div>
						<div class="form-group">
							<label for="login" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="login">
							</div>
						</div>
						<div class="form-group">
							<label for="pwd" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input class="form-control" type="password" name="pwd" maxlength="10">
							</div>
						</div>
						<div class="form-group">
							<label for="tipe" class="col-sm-2 control-label">Akses User</label>
							<div class="col-sm-10">
								<select class="form-control" id="tipe" name="tipe">
									<option value="" disabled selected>Pilih Akses User</option>
									@foreach ($role as $r)
									<option value="{{ $r->id }}">{{ $r->tipe_user }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="foto" class="col-sm-2 control-label">Foto</label>
							<div class="col-sm-10">
								<input class="form-control" type="file" name="foto">
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<a href="{{ route('admin.usermanager') }}" type="button" class="btn btn-default" id="btn-cancel">Batal</a>
						<button type="submit" class="btn btn-info pull-right">Simpan</button>
					</div>
					<!-- /.box-footer -->
				</form>


			</div>
		</div>
	</div>
</section>
<!-- right col -->
@endsection