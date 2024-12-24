@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
  <h1>
    Kategori Berita <!--Eksternal-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kategori Berita Eksternal</li>
  </ol>
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
        <form class="form-horizontal" action="{{ route('kategori-berita.update', $kategoriBerita->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="box-body">
            <div class="form-group">
              <label for="nama_kategori" class="col-sm-2 control-label">Nama Kategori</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="nama_kategori" value="{{$kategoriBerita->nama_kategori}}">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{ route('admin.kategori-berita')}}" class="btn btn-default" id="btn-cancel">Batal</a>
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