@extends('layouts.master')
@section('title', 'Pengajuan Pruchase')
@section('content')
    <div class="main">

        <!-- BOF Breadcrumb -->
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                    <li class="breadcrumb-item"><a href="/pengajuan-purchase">Pengajuan Pruchase</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
        <!-- EOF Breadcrumb -->

        <!-- BOF MAIN-BODY -->
        
            <div class="row">
                <!-- Form Kode -->
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="post" action="{{ url('pengajuan-purchase/ajukan') }}" novalidate
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kode</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            value="{{ $kode }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tanggal</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="tanggal"
                                            value="{{ $tanggal }}" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-paper-plane"></i>
                                        Ajukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Tabel Pengajuan -->
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="caption uppercase">
                                <i class="ti-file"></i> Detail pengajuan
                            </span>
                            <a href="javascript:;" class="btn btn-sm btn-success exampleModalSize" data-size="lg">
                                <i class="ti-plus"></i> Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover init-datatable" id="detail_table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="10">#</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Tempat</th>
                                            <th>Sub Total</th>
                                            <th>Status</th>
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
    
    <div class="modal fade" id="exampleModalSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <form method="post" id="tambah_form" action="{{ url('pengajuan-purchase/simpan') }}" novalidate enctype="multipart/form-data">
                            @csrf
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Inventory List</label>
                                        <div class="col">
                                            <input type="hidden" class="form-control" name="kode" value="{{ $kode }}" readonly>
                                            <select class="form-control selectpicker" id="inventoryList" name="id_inventory">
                                                <option value="" selected disabled>Pilih Inventory</option>
                                                @foreach ($inventory as $item)
                                                    <option value="{{ $item->id }}" data-harga="{{ $item->harga }}"
                                                        data-tempat="{{ $item->tempat }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Harga</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="harga" id="harga" readonly>
                                            <input type="hidden" ass="form-control" name="tempat" id="tempat" readonly>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">QTY</label>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="qty" name="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Sub Total</label>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="sub_total" name="sub_total" readonly>
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
        $(document).ready(function() {
            getData();
            function calculateSubtotal() {
                var harga = parseFloat($('#harga').val()) || 0;
                var qty = parseInt($('#qty').val()) || 0;
                var subtotal = harga * qty;
                $('#sub_total').val(subtotal);
            }


            $('#inventoryList').change(function() {
                var selectedOption = $(this).find('option:selected');
                var harga = selectedOption.data('harga');
                var tempat = selectedOption.data('tempat');

                $('#harga').val(harga);
                $('#tempat').val(tempat);


                calculateSubtotal();
            });


            $('#qty').on('input', function() {
                calculateSubtotal();
            });

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

            var detail_table = $('#detail_table').DataTable({
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
                    data: "qty"
                },
                {
                    data: "harga"
                },
                {
                    data: "tempat"
                },
                {
                    data: "subtotal"
                },
                {
                    data: "status"
                },
                {
                    data: "aksi",
                    class: "text-center"
                },
            ]
        });
    
        detail_table.on('order.dt search.dt', function() {
            detail_table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        
        function getData() {
            var id = "{{url('pengajuan-purchase/getdatadetail')}}" + "/" + document.getElementById("kode").value;
            detail_table.ajax.url(id).load(null, false);
        }

        function hapus(id) {
            $.ajax({
                url: "{{ url('pengajuan-purchase/delete') }}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        getData();
                    } else {
                        Swal.fire('Gagal!',
                            'Data gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.',
                            'error');
                        getData();
                    }
                },
                error: function(err) {
                    Swal.fire('Error!', 'Lihat errornya di console.', 'error');
                    location.reload();
                }
            });
        }
    </script>
    @if (session('Save'))
        <script>
            Swal.fire('Berhasil!', 'Data Berhasil Disimpan.', 'success');
        </script>
    @endif

@endsection
