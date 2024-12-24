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
                    <h3 class="box-title">Tambah Data</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.foto.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="upload_type" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="radio" id="single_upload" onclick="functioncheck()" name="upload_type" value="single_upload" checked=""> Single Upload
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="multiple_upload" onclick="functioncheck()" name="upload_type" value="multiple_upload"> Multiple Upload
                            </div>
                        </div>
                        <div id="single_upload_div">
                            <div class="form-group">
                                <label for="gambar" class="col-sm-2 control-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="foto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="keterangan">
                                </div>
                            </div>
                        </div>
                        <div id="multiple_upload_div" style="display: none;">
                            <div class="form-group">
                                <label for="gambar" class="col-sm-2 control-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="fotos[]" multiple>
                                </div>
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
                        <a href="{{route('admin.all-foto')}}" class="btn btn-default" id="btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>

                <script type="text/javascript">
                    function functioncheck() {
                        if (document.getElementById('multiple_upload').checked) {
                            document.getElementById('multiple_upload_div').style.display = "block";
                            document.getElementById('single_upload_div').style.display = "none";
                        } else {
                            document.getElementById('single_upload_div').style.display = "block";
                            document.getElementById('multiple_upload_div').style.display = "none";
                        }
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        functioncheck(); // Panggil saat halaman dimuat untuk set awal
                    });
                </script>
            </div>
        </div>
    </div>
</section>
<!-- right col -->
@endsection