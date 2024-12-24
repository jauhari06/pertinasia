@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Akun Saya
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Akun Saya</li>
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
                <form class="form-horizontal" action="{{ route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="nama" value="{{ auth()->user()->nama }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="login" value="{{ auth()->user()->login }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="pwd" value="" maxlength="10"> <span style=" color:red; ">*) Jangan diisi jika tidak diganti</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="foto"> <span style=" color:red; ">*) Pilih jika ingin mengganti foto</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.profile')}}" type="button" class="btn btn-default" id="btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection