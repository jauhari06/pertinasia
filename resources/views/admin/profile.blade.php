@extends('admin.layouts.admin')

@section('content')
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
                <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10 " style=" padding: 10px; ">
                                {{ auth()->user()->nama }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                {{ auth()->user()->login }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Akses User</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                <span>
                                    @if(auth()->user()->tipeUser)
                                    {{ auth()->user()->tipeUser->tipe_user }}
                                    @elseif(auth()->user()->tipe == 99)
                                    Super Administrator
                                    @else
                                    N/A
                                    @endif
                                <span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Login Terakhir</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                {{ auth()->user()->last_login }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                @if(auth()->user()->foto)
                                <img src="{{ asset('img/profile/' . auth()->user()->foto) }}"
                                    class="img-circle"
                                    alt="User Image"
                                    style="width: 100px; height: 100px; border: 3px solid #EFEFEF; border-radius: 50%;">
                                @else
                                <img src="{{ asset('img/profile/default.png') }}"
                                    class="img-circle"
                                    alt="Default User Image"
                                    style="width: 100px; height: 100px; border: 3px solid #EFEFEF; border-radius: 50%;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('edit.profile')}}" type="button" class="btn btn-default">Edit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- right col -->
@endsection