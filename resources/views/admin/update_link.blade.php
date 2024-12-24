@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
  <h1>
    Link
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Link</li>
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
        <form class="form-horizontal" action="{{route('link.update', $alllink->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="box-body">
            <div class="form-group">
              <label for="nama_link" class="col-sm-2 control-label">Nama Link</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="nama_link" value="{{$alllink->nama_link}}">
              </div>
            </div>
            <div class="form-group">
              <label for="link" class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="link" value="{{$alllink->link}}">
              </div>
            </div>
            <div class="form-group">
              <label for="id_kategori" class="col-sm-2 control-label">Kategori Link</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_kategori">
                  <option value="">-- Pilih Kategori Link --</option>
                  @foreach ($kategoriLink as $kL)
                  <option value="{{ $kL->id }}" {{ $kL->id == $alllink->id_kategori ? 'selected' : '' }}>
                    {{ $kL->nama_kategori }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{ route('admin.link')}}" class="btn btn-default" id="btn-cancel">Batal</a>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
  </div>
</section>
@endsection