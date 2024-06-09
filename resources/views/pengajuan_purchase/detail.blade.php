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
                    <li class="breadcrumb-item active">Detail Data</li>
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
                            <form method="post" action="{{ url('/pengajuan-purchase-setujui') }}" novalidate
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kode</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            value="{{ $data->kode }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tanggal</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="tanggal"
                                            value="{{ $data->tanggal }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"
                                            @if ($data->acc == 0)
                                                value="Menunggu Persetujuan"
                                            @elseif ($data->acc == 1)
                                                value="Proses Belanja"
                                            @elseif ($data->acc == 2)
                                                value="Sedang Verifikasi Finance"
                                            @elseif ($data->acc == 3)
                                                value="Selesai"
                                            @endif readonly>
                                    </div>
                                </div>
                                @if ($data->acc != 0)
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Lihat File Bukti Transfer</label>
                                        <div class="col-md-9">
                                            <a href="/purchase/{{ $data->bukti }}" target="_blank" class="btn btn-md btn-primary"><i class="fa fa-download"></i> Download</a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Lihat File Kwitansi</label>
                                        <div class="col-md-9">
                                            <a href="/purchase/{{ $data->kwitansi }}" target="_blank" class="btn btn-md btn-primary"><i class="fa fa-download"></i> Download</a>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->role_id == 3 && $data->acc == 0)
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Bukti Transfer</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="bukti" readonly>
                                    </div>
                                </div>
                                @endif
                                @if (Auth::user()->role_id == 4 && $data->acc == 1)
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kwitansi Belanja</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="kwitansi" readonly>
                                    </div>
                                </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-end">
                                    @if (Auth::user()->role_id == 3 && $data->acc == 0)
                                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-paper-plane"></i> Setujui</button>
                                    @elseif (Auth::user()->role_id == 4 && $data->acc == 1)
                                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                                    @elseif (Auth::user()->role_id == 3 && $data->acc == 2)
                                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-paper-plane"></i> Selesai Purchase</button>
                                    @endif
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
            var id = "{{url('pengajuan-purchase/getdetailperif')}}" + "/" + document.getElementById("kode").value;
            detail_table.ajax.url(id).load(null, false);
        }

        function acc(id,status) {
            $.ajax({
                url: "{{ url('pengajuan-purchase-acc') }}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status:status
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                       getData();
                    } else {
                        getData();
                    }
                },
                error: function(err) {
                    Swal.fire('Error!', 'Lihat errornya di console.', 'error');
                    getData();
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
