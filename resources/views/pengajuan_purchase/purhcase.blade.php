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
                                <table class="table table-bordered table-hover init-datatable" id="supplier_table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Total Item</th>
                                            <th>Total Pembayaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->total_item }}</td>
                                                <td>{{ $item->total_payment }}</td>
                                                <td>
                                                    @if ($item->acc == 0)
                                                        Pengajuan Baru
                                                    @elseif($item->acc == 1)
                                                        Dalam Proses
                                                    @elseif($item->acc == 2)
                                                        Selesai    
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="/pengajuan-purchase-detail/{{ $item->id }}">Detail</a>
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

        <!-- EOF MAIN-BODY -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

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
                        url: "{{ url('inventory-list/resep/hapus') }}",
                        type: "post",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                Swal.fire('Berhasil!', 'Data Inventory berhasil dihapus.', 'success');
                                location.reload();
                            } else {
                                Swal.fire('Gagal!',
                                    'Data Inventory gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.',
                                    'error');
                                location.reload();
                            }
                        },
                        error: function(err) {
                            Swal.fire('Error!', 'Lihat errornya di console.', 'error');
                            location.reload();
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
