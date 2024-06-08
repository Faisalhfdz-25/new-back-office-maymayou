@extends('layouts.master')
@section('title','Toko List')
@section('content')
<div class="main">

    <!-- BOF Breadcrumb -->
    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                <li class="breadcrumb-item active">Toko List</li>
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
                        <i class="ti-file"></i> Toko List
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="btn btn-sm btn-success exampleModalSize" data-size="lg"><i class="ti-plus"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover init-datatable" id="toko_table">
                            <thead class="thead-light">
                                <tr>
                                    <th width="10">#</th>
                                    <th>Name</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                    <form method="post" id="tambah_form" action="{{url('toko/store')}}" novalidate enctype="multipart/form-data">
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
                                    <label class="col-md-3 col-form-label">Alamat</label>
                                    <div class="col">
                                        <textarea class="form-control" name="alamat"></textarea>
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
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" id="edit_form" action="{{url('toko/update')}}" novalidate enctype="multipart/form-data">
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
                                    <label class="col-md-3 col-form-label">Alamat</label>
                                    <div class="col">
                                        <textarea class="form-control" name="alamat" id="alamat_edit"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary saveButton">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

$(document).ready(function(){
            getData();

            $('#tambah_form').validate({
                highlight: function(input) {
                    $(input).parents('.form-line').addClass('is-invalid');
                },
                unhighlight: function(input) {
                    $(input).parents('.form-line').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $('.saveButton').prop('disabled', true);
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            $('.saveButton').prop('disabled', false);
                            if (data.success) {
                                Swal.fire('Selamat!', 'Data Berhasil disimpan!', 'success');
                                $('#exampleModalSize').modal('hide');
                                getData();
                            } else {
                                Swal.fire('Maaf!', 'Data Gagal disimpan, silahkan coba beberapa saat lagi!', 'error');
                                $('#exampleModalSize').modal('hide');
                                getData();
                            }
                        },
                        error: function(err) {
                            $('.saveButton').prop('disabled', false);
                        }
                    });
                }
            });

            $('#edit_form').validate({
                highlight: function(input) {
                    $(input).parents('.form-line').addClass('is-invalid');
                },
                unhighlight: function(input) {
                    $(input).parents('.form-line').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $('.saveButton').prop('disabled', true);
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            $('.saveButton').prop('disabled', false);
                            if (data.success) {
                                Swal.fire('Selamat!', 'Perubahan Data Berhasil Disimpan!', 'success');
                                $('#edit_modal').modal('hide');
                                getData();
                            } else {
                                Swal.fire('Maaf!', 'Perubahan Data Gagal disimpan, silahkan coba beberapa saat lagi!', 'error');
                                $('#edit_modal').modal('hide');
                                getData();
                            }
                        },
                        error: function(err) {
                            $('.saveButton').prop('disabled', false);
                        }
                    });
                }
            });
        });

        var toko_table = $('#toko_table').DataTable({
        responsive: true,
        processing: true,
        ajax: "",
        columns: [{
                searchable: false,
                orderable: false,
                data: null,
                defaultContent: ''
            },
            {
                data: "nama"
            },
            {
                data: "alamat"
            },
            {
                data: "aksi",
                class: "text-center"
            },
        ]
    });
    
    toko_table.on('order.dt search.dt', function() {
        toko_table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    
    function getData() {
        toko_table.ajax.url("{{url('toko/getdata')}}").load(null, false);
    }

    
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
                        url: "{{url('toko/delete')}}",
                        type: "post",
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                Swal.fire('Berhasil!', 'Data Toko berhasil dihapus.', 'success');
                                getData();
                            } else {
                                Swal.fire('Gagal!', 'Data Toko gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.', 'error');
                                getData();
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
            url: "{{url('toko/getDetail')}}",
            type: "get",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#id_edit').val(id);
                $('#nama_edit').val(data.nama);
                $('#alamat_edit').val(data.alamat);
                $("#edit_modal").modal("show");
            },
            error: function(err) {}
        });
    }
    </script>
@endsection