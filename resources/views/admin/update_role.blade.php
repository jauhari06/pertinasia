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
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('role.update', $role->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_menu" class="col-sm-2 control-label">Tipe User</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="tipe_user" value="{{ $role->tipe_user }}">
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">Nama Menu</th>
                                    <th width="15%" class="column-title">Tambah</th>
                                    <th width="10%" class="column-title">Edit</th>
                                    <th width="13%" class="column-title">Hapus</th>
                                    <th width="9%" class="column-title">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {!!$menuHierarchy!!}
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer">
                    <a href="{{ route('admin.role') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
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

    $(document).ready(function() {
        // Handle parent checkbox selection
        $('input[name="id_menu[]"]').change(function() {
            var isChecked = $(this).is(':checked');
            var parentRow = $(this).closest('tr');

            // Only check/uncheck the child rows directly below this parent row
            if (parentRow.hasClass('parent')) {
                // Check/uncheck all children of this parent
                parentRow.nextUntil('tr.parent').each(function() {
                    $(this).find('input[name="id_menu[]"]').prop('checked', isChecked);
                    $(this).find('input[type="checkbox"]').prop('checked', isChecked); // Check/uncheck tambah, edit, hapus, status
                });
            }
        });

        // Handle child checkbox selection
        $('input[name="id_menu[]"]').each(function() {
            var row = $(this).closest('tr');
            if (row.hasClass('child')) {
                $(this).change(function() {
                    var isChecked = $(this).is(':checked');
                    // Only check/uncheck tambah, edit, hapus, status of this child
                    row.find('input[type="checkbox"]').not(this).prop('checked', isChecked);
                });
            }
        });
    });
</script>
@endsection