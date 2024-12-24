@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
	<h1>
		Menu
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Menu</li>
	</ol>
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
				<form class="form-horizontal" action="{{ route('admin.create-menu')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="box-body">
						<div class="form-group">
							<label for="nama_menu" class="col-sm-2 control-label">Nama Menu</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="nama_menu">
							</div>
						</div>
						<div class="form-group">
							<label for="parameter" class="col-sm-2 control-label">Parameter</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="parameter">
							</div>
						</div>
						<div class="form-group">
							<label for="nama_menu" class="col-sm-2 control-label">Parent</label>
							<div class="col-sm-10">
								<select name="parent" class="form-control">
									<option value="">-</option>
									@foreach ($menu as $m)
									<option value="{{ $m->id }}">{{ $m->nama_menu }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="tipe" class="col-sm-2 control-label">Tipe</label>
							<div class="col-sm-10">
								<select name="tipe" class="form-control">
									<option value="custom">Custom</option>
									<option value="statis">Deskripsi</option>
									<option value="link">Link URL</option>
									<!-- <option value="listurl">List URL</option> -->
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="icon_class" class="col-sm-2 control-label">Menu Utama</label>
							<div class="col-sm-10" style=" padding: 10px; ">
								<label>
									<input type="radio" name="tampil" value="N" class="minimal"> Tidak
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="tampil" value="Y" class="minimal"> Ya
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="urut" class="col-sm-2 control-label">Urut</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="urut">
							</div>
						</div>
						<div class="form-group">
							<label for="icon_class" class="col-sm-2 control-label">Icon Class</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="icon_class">
							</div>
						</div>
						<div class="form-group">
							<label for="icon_class" class="col-sm-2 control-label">Sub Page</label>
							<div class="col-sm-10" style=" padding: 10px; ">
								<label>
									<input type="radio" name="subpage" value="N" class="minimal" checked> Tidak
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="subpage" value="Y" class="minimal"> Ya
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="icon_class" class="col-sm-2 control-label">Add to shortcut</label>
							<div class="col-sm-10" style=" padding: 10px; ">
								<label>
									<input type="radio" name="shortcut" value="N" class="minimal" checked> Tidak
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="shortcut" value="Y" class="minimal"> Ya
								</label>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<a href="{{route('admin.menu')}}" class="btn btn-default" id="btn-cancel">Batal</a>
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