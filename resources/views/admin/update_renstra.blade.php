@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
  <h1>
    Renstra
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Renstra</li>
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
        <form class="form-horizontal" action="{{ route('admin.update-renstra', $renstra->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="box-body">
              <div class="form-group">
                <label for="teks" class="col-sm-2 control-label">Link URL</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="deskripsi" value="{{$renstra->deskripsi}}">
                </div>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{ route('admin.renstra')}}" class="btn btn-default" id="btn-cancel">Batal</a>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>

        <!-- /.box -->
      </div>
    </div>
  </div>
</section>
@endsection