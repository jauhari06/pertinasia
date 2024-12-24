@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        User Role
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Role</li>
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
                                    <a href="{{route('admin.add-role')}}" class="btn btn-primary" id="btn-add" data-placement="top" data-toggle="tooltip" data-original-title="Tambah">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-info" id="btn-refresh" data-placement="top" data-toggle="tooltip" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-tools" style="width: 150px;">
                            <form method="get" action="{{ route('role.search') }}">
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
                                <th>Tipe User</th>
                                <th style=" width: 10%; ">Action</th>
                            </tr>
                            @foreach($role as $r)
                            <tr>
                                <td>{!! \App\Helpers\Helper::highlight( $r->tipe_user, $key ?? '' ) !!}</td>
                                <td>
                                    <a href="{{ route('role.update', $r->id) }}" title="Edit" data-placement="top" data-toggle="tooltip" class="btn btn-xs tooltips btn-info">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('role.delete', $r->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button title="" data-placement="top" data-toggle="tooltip" type="submit" data-original-title="Hapus" class="btn btn-xs tooltips btn-danger">
                                            <i class="fa fa-trash-o"></i>
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
                            Menampilkan {{ $role->count() }} data dari total {{ $role->total() }} data
                        </div>
                        <div class="col-md-6 text-right">
                            {{ $role->links('vendor.pagination') }}
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</section>
<!-- right col -->
<script>
    var radio_button = false;
    $('.total_id').on("click", function(event) {
        var this_input = $(this);
        var temp = false;
        if (this_input.attr('checked1') == '11') {

            this_input.attr('checked1', '11')
            temp = true;


        } else {
            temp = false;
            this_input.attr('checked1', '22')

        }
        $('.total').prop('checked', false);
        $('.total').attr('checked1', '22')
        if (temp) {
            $('.' + this.value).prop('checked', false);
            this_input.prop('checked', false);
            this_input.attr('checked1', '22')
        } else {
            $('.' + this.value).prop('checked', true);
            this_input.prop('checked', true);
            this_input.attr('checked1', '11')
        }

    });
</script>
@endsection