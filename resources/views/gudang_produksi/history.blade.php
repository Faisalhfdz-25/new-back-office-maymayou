@extends('layouts.master')
@section('title', 'History Produksi')
@section('content')
    <div class="main">

        <!-- BOF Breadcrumb -->
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                    <li class="breadcrumb-item"><a href="/gudang-produksi"></a>Gudang Produksi</li>
                    <li class="breadcrumb-item active">History </li>
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
                            <i class="ti-file"></i> History Produksi
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover init-datatable" id="supplier_table">
                                <thead class="thead-light">
                                    <tr>
                                        
                                        <th>ID Inventory</th>
                                        <th>Satuan</th>
                                        <th>Qty</th>
                                        <th>Stock</th>
                                        <th>Harga</th>
                                        <th>Tanggal Pengadaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_produksi as $item)
                                        <tr>
                                            
                                            <td>{{ $item->id_inventory }}</td>
                                            <td>{{ $item->satuan }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ $item->harga }}</td>
                                            <td>{{ $item->tanggal_pengadaan }}</td>

                                            
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
                        url: "{{ url('inventory-list/hapus') }}",
                        type: "post",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                Swal.fire('Berhasil!', 'Data Inventory berhasil dihapus.', 'success');
                                location.reload()
                            } else {
                                Swal.fire('Gagal!',
                                    'Data Inventory gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.',
                                    'error');
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
    </script>
    @if (session('Save'))
        <script>
            Swal.fire('Berhasil!', 'Data Berhasil Berhasil Disimpan.', 'success');
        </script>
    @endif
@endsection
