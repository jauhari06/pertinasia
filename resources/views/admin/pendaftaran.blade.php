@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
  <h1>Pendaftaran</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pendaftaran</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="box-title">
            <div class="col-md-12">
              <div class="btn-group">
                <button class="btn btn-info" id="btn-refresh" title="Refresh">
                  <i class="fa fa-refresh"></i>
                </button>
              </div>
            </div>
          </div>
          {{-- search --}}
          <div class="box-tools" style="width: 150px;">
            <form method="get" action="{{ route('pendaftaran.search') }}">
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

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>Nama PTS</th>
              <th>Alamat PTS</th>
              <th>Nama Lengkap</th>
              <th style="width: 10%;">Action</th>
            </tr>
            @foreach ($pendaftaran as $l)
            <tr>
              <td>{!! \App\Helpers\Helper::highlight($l->nama_pts, $key ?? '') !!}</td>
              <td>{!! \App\Helpers\Helper::highlight($l->alamat_pts, $key ?? '') !!}</td>
              <td>{!! \App\Helpers\Helper::highlight($l->nama, $key ?? '') !!}</td>
              <td>
                <a class="btn btn-xs btn-primary tooltips" title="View" data-toggle="modal" data-target="#viewModal-{{ $l->id }}">
                  <i class="fa fa-eye"></i>
                </a>
                <button title="Edit" class="btn btn-xs btn-info" data-toggle="modal" data-target="#editModal-{{ $l->id }}">
                  <i class="fa fa-pencil"></i>
                </button>
                <form id="delete-form-{{ $l->id }}" action="{{ route('deletePendaftaran', ['id' => $l->id]) }}" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
                </form>
                <button class="btn btn-xs btn-danger tooltips" title="Hapus" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $l->id }}').submit();">
                  <i class="fa fa-trash-o"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
        @foreach ($pendaftaran as $p)

        
        <!-- Modal View -->
        <div class="modal fade" id="viewModal-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Detail Data {{ $p->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group"><label>Nama PTS</label><input type="text" class="form-control" disabled value="{{ $p->nama_pts }}"></div>
                    <div class="form-group"><label>Alamat PTS</label><input type="text" class="form-control" disabled value="{{ $p->alamat_pts }}"></div>
                    <div class="form-group"><label>Kota/Kab PTS</label><input type="text" class="form-control" disabled value="{{ $p->kota_pts }}"></div>
                    <div class="form-group"><label>Kode Pos PTS</label><input type="text" class="form-control" disabled value="{{ $p->pos_pts }}"></div>
                    <div class="form-group"><label>Tahun Berdiri PTS</label><input type="text" class="form-control" disabled value="{{ $p->thn_berdiri }}"></div>
                    <div class="form-group"><label>Jumlah Prodi PTS</label><input type="text" class="form-control" disabled value="{{ $p->jmlh_prodi }}"></div>
                    <div class="form-group"><label>Email PTS</label><input type="text" class="form-control" disabled value="{{ $p->email_pts }}"></div>
                    <div class="form-group"><label>Telepon Kantor PTS</label><input type="text" class="form-control" disabled value="{{ $p->tlp_pts }}"></div>
                    <div class="form-group"><label>Fax Kantor PTS</label><input type="text" class="form-control" disabled value="{{ $p->fax_pts }}"></div>
                    <div class="form-group"><label>Website Kantor PTS</label><input type="text" class="form-control" disabled value="{{ $p->web_pts }}"></div>

                    <!-- Other fields for PTS details here... -->
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group"><label>Nama Lengkap (Dengan Gelar)</label><input type="text" class="form-control" disabled value="{{ $p->nama }}"></div>
                    <div class="form-group"><label>Tempat Lahir</label><input type="text" class="form-control" disabled value="{{ $p->tmp_lahir }}"></div>
                    <div class="form-group"><label>Tanggal Lahir</label><input type="text" class="form-control" disabled value="{{ $p->tgl_lahir }}"></div>
                    <div class="form-group"><label>Masa Jabatan</label><input type="text" class="form-control" disabled value="{{ $p->masa_jbtn }}"></div>
                    <div class="form-group"><label>Alamat Rumah (Lengkap)</label><input type="text" class="form-control" disabled value="{{ $p->alamat }}"></div>
                    <div class="form-group"><label>Kota/Kab</label><input type="text" class="form-control" disabled value="{{ $p->kota }}"></div>
                    <div class="form-group"><label>Kode Pos</label><input type="text" class="form-control" disabled value="{{ $p->kode_pos }}"></div>
                    <div class="form-group"><label>Telepon</label><input type="text" class="form-control" disabled value="{{ $p->tlpn }}"></div>
                    <div class="form-group"><label>Handphone</label><input type="text" class="form-control" disabled value="{{ $p->handphone }}"></div>
                    <div class="form-group"><label>Email</label><input type="text" class="form-control" disabled value="{{ $p->email }}"></div>
                    <!-- Other fields for personal details here... -->
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('cetak', $p->id) }}'">Cetak Pendaftaran</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Edit untuk Setiap Item Pendaftaran -->
@foreach ($pendaftaran as $p)
<div class="modal fade" id="editModal-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data {{ $p->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updatePendaftaran', $p->id )}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama_pts">Nama PTS</label>
                                <input class="form-control" type="text" id="nama_pts" name="nama_pts" value="{{ $p->nama_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat_pts">Alamat PTS</label>
                                <input class="form-control" type="text" id="alamat_pts" name="alamat_pts" value="{{ $p->alamat_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="kota_pts">Kota/Kab PTS</label>
                                <input class="form-control" type="text" id="kota_pts" name="kota_pts" value="{{ $p->kota_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="pos_pts">Kode Pos PTS</label>
                                <input class="form-control" type="text" id="pos_pts" name="pos_pts" value="{{ $p->pos_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="thn_berdiri">Tahun Berdiri PTS</label>
                                <input class="form-control" type="text" id="thn_berdiri" name="thn_berdiri" value="{{ $p->thn_berdiri }}">
                            </div>
                            <div class="form-group">
                                <label for="jmlh_prodi">Jumlah Prodi PTS</label>
                                <input class="form-control" type="text" id="jmlh_prodi" name="jmlh_prodi" value="{{ $p->jmlh_prodi }}">
                            </div>
                            <div class="form-group">
                                <label for="email_pts">Email PTS</label>
                                <input class="form-control" type="text" id="email_pts" name="email_pts" value="{{ $p->email_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="tlp_pts">Telepon Kantor PTS</label>
                                <input class="form-control" type="text" id="tlp_pts" name="tlp_pts" value="{{ $p->tlp_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="fax_pts">Fax Kantor PTS</label>
                                <input class="form-control" type="text" id="fax_pts" name="fax_pts" value="{{ $p->fax_pts }}">
                            </div>
                            <div class="form-group">
                                <label for="web_pts">Website Kantor PTS</label>
                                <input class="form-control" type="text" id="web_pts" name="web_pts" value="{{ $p->web_pts }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap (Dengan Gelar)</label>
                                <input class="form-control" type="text" id="nama" name="nama" value="{{ $p->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input class="form-control" type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $p->tmp_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input class="form-control" type="text" id="tgl_lahir" name="tgl_lahir" value="{{ $p->tgl_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="masa_jbtn">Masa Jabatan</label>
                                <input class="form-control" type="text" id="masa_jbtn" name="masa_jbtn" value="{{ $p->masa_jbtn }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Rumah (Lengkap)</label>
                                <input class="form-control" type="text" id="alamat" name="alamat" value="{{ $p->alamat }}">
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota/Kab</label>
                                <input class="form-control" type="text" id="kota" name="kota" value="{{ $p->kota }}">
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input class="form-control" type="text" id="kode_pos" name="kode_pos" value="{{ $p->kode_pos }}">
                            </div>
                            <div class="form-group">
                                <label for="tlpn">Telepon</label>
                                <input class="form-control" type="text" id="tlpn" name="tlpn" value="{{ $p->tlpn }}">
                            </div>
                            <div class="form-group">
                                <label for="handphone">Handphone</label>
                                <input class="form-control" type="text" id="handphone" name="handphone" value="{{ $p->handphone }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ $p->email }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Apakah anda yakin ingin menghapus Link {{ $p->nama_link }}?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('deletePendaftaran', $p->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
</section>
@endsection
