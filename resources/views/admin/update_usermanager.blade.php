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
                    <h3 class="box-title">Edit Data</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form class="form-horizontal" action="{{ route('usermanager.update', $usermanager->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="nama" value="{{ $usermanager->nama }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="login" value="{{ $usermanager->login }}" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="pwd"> <span style=" color:red; ">*) Jangan diisi jika tidak diganti</span>
                            </div>
                        </div>
                        @if ($usermanager->tipe != 99)
                        <div class="form-group">
                            <label for="tipe" class="col-sm-2 control-label">Akses User</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="tipe" name="tipe">
                                    <option value="{{ $usermanager->tipeUser }}" disabled selected>
                                        {{ $usermanager->tipeUser->tipe_user ?? 'Pilih Akses User' }}
                                    </option>
                                    @foreach ($role as $r)
                                    @if($r->id != $usermanager->tipe)
                                    <option value="{{ $r->id }}">{{ $r->tipe_user }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="foto" class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="foto"> <span style=" color:red; ">*) Pilih jika ingin mengganti foto</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.usermanager')}}" class="btn btn-default" id="btn-cancel">Batal</a>
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