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
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="update-foto.inc.php" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="box-body">
            <div class="form-group">
              <label for="gambar" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" name="gambar"> <span style=" color:red; ">*) Pilih jika ingin mengganti gambar</span>
              </div>
            </div>
            <div class="form-group">
              <label for="keterangan" class="col-sm-2 control-label">Deskripsi</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="keterangan" value="{{ route($foto->keterangan)}}">
              </div>
            </div>
            <div class="form-group">
              <label for="id_album" class="col-sm-2 control-label">Album</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_album">
                  <option value="">-- Pilih Album --</option>
                  @foreach ($allAlbum as $aA)
                  <option value="{{ $aA->id }}">
                    {{ $aA->nama_album }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{route('admin.foto')}}" class="btn btn-default" id="btn-cancel">Batal</a>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- right col -->
@endsection