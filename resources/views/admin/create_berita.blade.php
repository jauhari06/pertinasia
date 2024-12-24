@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Daftar Berita <!--Eksternal-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Berita Eksternal</li>
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
        <form class="form-horizontal" action="{{ route('admin.berita.create')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="judul" class="col-sm-2 control-label">Judul</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="judul">
              </div>
            </div>
            <div class="form-group">
              <label for="id_kategori" class="col-sm-2 control-label">Kategori Berita</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_kategori">
                  <option value="">-- Pilih Kategori Berita --</option>
                  @foreach ($kategori as $k)
                  <option value="{{ $k->id }}">
                    {{ $k->nama_kategori }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
              <div class="col-sm-10">
                <textarea class="form-control ckeditor" name="deskripsi"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="file" class="col-sm-2 control-label">File</label>
              <div class="col-sm-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style=" background-color: #CCC; ">Nama File</th>
                      <th style=" background-color: #CCC; ">File</th>
                      <th style=" background-color: #CCC; width: 5%; ">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody class="field_wrapper">
                    <tr>
                      <td><input type="text" id="nama_file" name="nama_file[]" class="form-control col-md-7 col-xs-12" autocomplete="off"></td>
                      <td><input type="file" id="file" name="file[]" class="form-control col-md-7 col-xs-12" autocomplete="off"></td>
                      <td><button type="button" class="btn btn-info" id="add-field"><i class="fa fa-plus"></i></button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{ route('admin.berita')}}" class="btn btn-default" id="btn-cancel">Batal</a>
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

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('deskripsi', {
        filebrowserUploadUrl: '/berita/upload-image?_token=' + document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection