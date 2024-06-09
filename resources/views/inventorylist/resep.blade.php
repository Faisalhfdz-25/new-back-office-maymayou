@extends('layouts.master')
@section('title','Inventory List')
@section('content')
    <div class="main">

        <!-- BOF Breadcrumb -->
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                    <li class="breadcrumb-item active">Inventory List</li>
                </ol>
            </div>
        </div>
        <!-- EOF Breadcrumb -->

        <!-- BOF MAIN-BODY -->
        <div class="row">
            <!-- BOF General Form -->
            <div class="col-lg-12">
                <div class="card mb-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kode</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="id" id="data_id" value="{{ $data->id }}">
                                        <input type="text" class="form-control" name="kode" value="{{ $data->kode }}" @readonly(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama" value="{{ $data->nama }}"@readonly(true)>
                                    </div>
                                </div>
                            </div>
                            
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="caption uppercase">
                            <i class="ti-file"></i> Recipe
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="btn btn-sm btn-success exampleModalSize" data-size="lg"><i class="ti-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover init-datatable" id="resep_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>QTY</th>
                                        <th>Harga</th>
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
        <!-- EOF MAIN-BODY -->
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
                        <form method="post" id="tambah_form" action="{{url('inventory-list/resep/simpan')}}" novalidate enctype="multipart/form-data">
                            @csrf
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Inventory List</label>
                                        <div class="col">
                                            <input type="hidden" class="form-control" name="id_produk" value="99">
                                            <select class="form-control selectpicker" name="id_inventory">
                                                @foreach ($inventory as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">QTY</label>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="qty">
                                            </div>
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
        });

        var resep_table = $('#resep_table').DataTable({
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
                data: "satuan"
            },
            {
                data: "qty"
            },
            {
                data: "harga"
            },
            {
                data: "aksi",
                class: "text-center"
            },
        ]
    });
    
    resep_table.on('order.dt search.dt', function() {
        resep_table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    
    function getData() {
        var id = "{{url('inventory-list/getdataresep')}}" + "/" + document.getElementById("data_id").value;
        resep_table.ajax.url(id).load(null, false);
    }


    function hapus(id) {
        $.ajax({
            url: "{{url('inventory-list/resep/hapus')}}",
            type: "post",
            data: {
                _token: '{{csrf_token()}}',
                id: id
            },
            dataType: "json",
            success: function(data) {
                if (data) {
                    getData();
                } else {
                    Swal.fire('Gagal!', 'Data Inventory gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.', 'error');
                    getData();
                }
            },
            error: function(err) {
                Swal.fire('Error!', 'Lihat errornya di console.', 'error');
                location.reload()
            }
        });
    }
    
    </script>
@endsection