@extends('layouts.master')
@section('title', 'Pengajuan Pruchase')
@section('content')
    <div class="main">

        <!-- BOF Breadcrumb -->
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                    <li class="breadcrumb-item active">Pengajuan Pruchase</li>
                </ol>
            </div>
        </div>
        <!-- EOF Breadcrumb -->

        <!-- BOF MAIN-BODY -->
            <div class="row">
                <!-- Tabel Pengajuan -->
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            @if (Auth::user()->role_id == 4)
                                <a href="/pengajuan-purchase-tambah" class="btn btn-sm btn-success" data-size="lg">
                                    <i class="ti-plus"></i> Tambah Data
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover init-datatable" id="pengajuan_table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="10">#</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Total Item</th>
                                            <th>Total Pembayaran</th>
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
       $(document).ready(function(){
            getData();
        });

        var pengajuan_table = $('#pengajuan_table').DataTable({
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
                    data: "kode"
                },
                {
                    data: "tanggal"
                },
                {
                    data: "item"
                },
                {
                    data: "total"
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
    
        pengajuan_table.on('order.dt search.dt', function() {
            pengajuan_table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        
        function getData() {
            pengajuan_table.ajax.url("{{url('pengajuan-purchase/getdata')}}").load(null, false);
        }
    </script>
    @if (session('Save'))
        <script>
            Swal.fire('Berhasil!', 'Data Berhasil Berhasil Disimpan.', 'success');
        </script>
    @endif

@endsection
