@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
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
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <div class="col-md-12">
                                <div class="btn-group">
                                    <a href="{{ route('admin.create-menu') }}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah"><i class="fa fa-plus"></i></a>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="box-tools" style="width: 150px;">
						<form method="get" action="{{ route('menu.search') }}">
							<div class="input-group input-group-sm">
								<input type="text" name="key" class="form-control pull-right" placeholder="Search" value="{{ old('key', $key ?? '') }}">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Nama Menu</th>
                                <th>Parameter</th>
                                <th>Parent</th>
                                <th>Tipe</th>
                                <th>Urut</th>
                                <th>Icon Class</th>
                                <th>Shortcut</th>
                                <th style=" width: 10%; ">Status</th>
                                <th style=" width: 10%; ">Action</th>
                            </tr>
                            @foreach($menu as $m)
                            <tr>
                                <td>{{$m->nama_menu}}</td>
                                <td>{{$m->parameter}}</td>
                                <td>{{$m->parentMenu ? $m->parentMenu->nama_menu : ''}}</td>
                                <td>
                                    @if ($m->tipe == "custom")
                                    <span>Custom</span>
                                    @elseif ($m->tipe == "statis")
                                    <span>Deskripsi</span>
                                    @elseif ($m->tipe == "listurl")
                                    <span>List Url</span>
                                    @else
                                    <span>Link URL</span>
                                    @endif
                                </td>
                                <td>{{$m->urut}}</td>
                                <td>{{$m->icon_class}}</td>
                                <td> @if ($m -> shortcut == "Y")
                                    <span>Ya</span>
                                    @else
                                    <span>Tidak</span>
                                    @endif
                                </td>
                                <td> @if ($m -> aktif == 1)
                                    <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('menu.edit', $m->id) }}" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Edit" class="btn btn-xs tooltips btn-info">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('menu.delete', $m->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Hapus" class="btn btn-xs tooltips btn-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('menu.toggleAktif', $m->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Set. Aktif / Non Aktif" class="btn btn-xs tooltips btn-warning">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="col-md-6">
                            Menampilkan {{ $menu->count() }} data dari total {{ $menu->total() }} data
                        </div>
                        <div class="col-md-6 text-right">
                            {{ $menu->links('vendor.pagination') }}
                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</section>
<!-- right col -->
@endsection