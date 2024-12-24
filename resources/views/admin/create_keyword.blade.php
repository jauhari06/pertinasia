@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <!-- <h1>
          Setting > Meta > Keyword
      </h1> -->
    <h1>
        Meta Keyword
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Meta Keyword</li>
    </ol><!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Meta Keyword</li>
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
                <form class="form-horizontal" action="{{ route('admin.create-keyword')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="teks" class="col-sm-2 control-label">Teks</label>
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Teks" type="text" name="teks">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.keyword')}}" class="btn btn-default" id="btn-cancel">Batal</a>
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