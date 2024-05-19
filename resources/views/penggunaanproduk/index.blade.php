@extends('layouts.master')
@section('title','Penggunaan Produk')
@section('content')
<div class="main">

    <!-- BOF Breadcrumb -->
    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                <li class="breadcrumb-item active">Penggunaan Produk</li>
            </ol>
        </div>
    </div>
    <!-- EOF Breadcrumb -->
    <!-- BOF Basic Datatable -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="caption uppercase">
                        <i class="ti-file"></i> Penggunaan Produk
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="btn btn-sm btn-success exampleModalSize" data-size="lg"><i class="ti-plus"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover init-datatable" id="supplier_table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="javascript:void(0);" onclick="edit('{{ $item->id }}')">Edit</a>
                                            <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="hapus('{{ $item->id }}')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" action="{{url('penggunaan-produk/simpan')}}" novalidate enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Keterangan</label>
                                    <div class="col">
                                        <textarea class="form-control" name="keterangan"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" action="{{url('penggunaan-produk/update')}}" novalidate enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="hidden" class="form-control" name="id" id="id_edit">
                                            <input type="text" class="form-control" name="nama" id="nama_edit">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Keterangan</label>
                                    <div class="col">
                                        <textarea class="form-control" name="keterangan" id="keterangan_edit"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function hapus(id) {
            Swal.fire({
                title: 'Yakin?',
                text: "Mau menghapus Data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF2C2C',
                confirmButtonText: 'Ya, Hapus aja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{url('penggunaan-produk/hapus')}}",
                        type: "post",
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                Swal.fire('Berhasil!', 'Data Penggunaan Produk berhasil dihapus.', 'success');
                                location.reload()
                            } else {
                                Swal.fire('Gagal!', 'Data Penggunaan Produk gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.', 'error');
                                location.reload()
                            }
                        },
                        error: function(err) {
                            Swal.fire('Error!', 'Lihat errornya di console.', 'error');
                            location.reload()
                        }
                    });
                }
            })
        }

        function edit(id) {
        $.ajax({
            url: "{{url('penggunaan-produk/getDetail')}}",
            type: "get",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#id_edit').val(id);
                $('#nama_edit').val(data.nama);
                $('#keterangan_edit').val(data.keterangan);
                $("#edit_modal").modal("show");
            },
            error: function(err) {}
        });
    }
    </script>
    @if(session('Save'))
        <script>
            Swal.fire('Berhasil!', 'Data Berhasil Disimpan.', 'success');
        </script>
    @endif
@endsection