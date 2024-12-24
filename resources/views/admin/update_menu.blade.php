@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        Menu
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Menu</li>
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
                <form class="form-horizontal" action="{{ route('menu.update', $menu->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_menu" class="col-sm-2 control-label">Nama Menu</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="nama_menu" value="{{ $menu->nama_menu}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="parameter" class="col-sm-2 control-label">Parameter</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="parameter" value="{{$menu->parameter}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_menu" class="col-sm-2 control-label">Parent</label>
                            <div class="col-sm-10">
                                <select name="parent" class="form-control">
                                    <option value="0" {{ $menu->parent == 0 ? 'selected' : '' }}>-</option>
                                    @foreach ($menus as $m)
                                    <option value="{{ $m->id }}" {{ $menu->parent == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama_menu }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipe" class="col-sm-2 control-label">Tipe</label>
                            <div class="col-sm-10">
                                <select name="tipe" class="form-control">
                                    <option value="custom" {{ $menu->tipe == 'custom' ? 'selected' : '' }}>Custom</option>
                                    <option value="statis" {{ $menu->tipe == 'statis' ? 'selected' : '' }}>Deskripsi</option>
                                    <option value="link" {{ $menu->tipe == 'link' ? 'selected' : '' }}>List Url</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon_class" class="col-sm-2 control-label">Menu Utama</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                <label style="display: inline-block;">
                                    <input type="radio" name="tampil" value="N" class="minimal" {{ $menu->tampil == 'N' ? 'checked' : '' }}>
                                    <span style="margin-left: 5px;">Tidak</span>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label style="display: inline-block;">
                                    <input type="radio" name="tampil" value="Y" class="minimal" {{ $menu->tampil == 'Y' ? 'checked' : '' }}>
                                    <span style="margin-left: 5px;">Ya</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="urut" class="col-sm-2 control-label">Urut</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="urut" value="{{ $menu->urut}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon_class" class="col-sm-2 control-label">Icon Class</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="icon_class" value="{{$menu->icon_class}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon_class" class="col-sm-2 control-label">Sub Page</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                <label style="display: inline-block;">
                                    <input type="radio" name="subpage" value="N" class="minimal" {{ $menu->subpage == 'N' ? 'checked' : '' }}>
                                    <span style="margin-left: 5px;">Tidak</span>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label style="display: inline-block;">
                                    <input type="radio" name="subpage" value="Y" class="minimal" {{ $menu->subpage == 'Y' ? 'checked' : '' }}>
                                    <span style="margin-left: 5px;">Ya</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon_class" class="col-sm-2 control-label">Add to shortcut</label>
                            <div class="col-sm-10" style=" padding: 10px; ">
                                <label style="display: inline-block;">
                                    <input type="radio" name="shortcut" value="N" class="minimal" {{ $menu->shortcut == 'N' ? 'checked' : '' }}>
                                    <span style="margin-left: 5px;">Tidak</span>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label style="display: inline-block;">
                                    <input type="radio" name="shortcut" value="Y" class="minimal" {{ $menu->shortcut == 'Y' ? 'checked' : '' }}>
                                    <span style="margin-left: 5px;">Ya</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <a href="{{ route('admin.menu')}}" class="btn btn-default" id="btn-cancel">Batal</a>
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