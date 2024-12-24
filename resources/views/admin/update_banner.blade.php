@extends('admin.layouts.admin')

@section('content')
<section class="content-header">

	<!-- <h1> Part Header > Banner </h1> -->

	<h1>

		Banner

	</h1>

	<ol class="breadcrumb">

		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

		<li class="active">Banner</li>

	</ol>

	<!--

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Banner</li>

      </ol>-->

</section>



<!-- Main content -->

<section class="content">

	<!-- Main row -->

	<div class="row">

		<div class="col-xs-12">

			<div class="box">

				<div class="box-header with-border">

					<h3 class="box-title">Edit Data</h3>

				</div>

				<!-- /.box-header -->

				<!-- form start -->
				<form class="form-horizontal" action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
                    @method('PUT')
					<div class="box-body">

						<div class="form-group">

							<label for="gambar" class="col-sm-2 control-label">Gambar</label>

							<div class="col-sm-10">

								<input class="form-control" type="file" name="banner">

								Ukuran Banner, &nbsp;&nbsp;<b>Width:</b>&nbsp;1350px &nbsp;&nbsp;<b>Height:</b>&nbsp;535px<br>



								<span style=" color:red; ">*) Pilih jika ingin mengganti gambar</span>

							</div>

						</div>

						<div class="form-group">

							<label for="login" class="col-sm-2 control-label">Urut</label>

							<div class="col-sm-2">

								<input class="form-control" name="urut" type="text" value="{{ $banner->urut }} ">

							</div>

						</div>

					</div>

					<!-- /.box-body -->

					<div class="box-footer">

						<a href="{{route('admin.banner')}}" class="btn btn-default" id="btn-cancel">Batal</a>

						<button type="submit" class="btn btn-info pull-right">Simpan</button>

					</div>

					<!-- /.box-footer -->

				</form>

				<!-- /.box -->

			</div>

		</div>

	</div>

</section>

<!-- right col -->

@endsection