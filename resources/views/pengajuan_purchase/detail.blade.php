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
        <div class="container">
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
                                        <input type="text" class="form-control" name="kode"
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
                                    <label class="col-md-3 col-form-label">Total</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="total"
                                            value="{{ $data->total_payment }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"
                                            @if ($data->acc == 0)
                                                value="Menunggu Persetujuan"
                                            @else
                                                value="Disetujui"
                                            @endif readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    @if (Auth::user()->role_id == 3 && $data->acc == 0)
                                        <a href="/pengajuan-purchase-setujui/{{ $data->kode }}" class="btn btn-md btn-primary"><i class="fa fa-paper-plane"></i> Setujui</a>
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
                                <table class="table table-bordered table-hover init-datatable" id="supplier_table">
                                    <thead class="thead-light">
                                        <tr>
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
                                        @foreach ($detail as $item)
                                            <tr>

                                                <td>{{ $item->inventory->nama }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->harga }}</td>
                                                <td>{{ $item->supplier->nama }}</td>
                                                <td>{{ $item->sub_total }}</td>
                                                @if ($item->acc == 0)
                                                    <td>Draft</td>
                                                @elseif($item->acc == 1)
                                                    <td>Disetujui</td>
                                                @elseif($item->acc == 2)
                                                    <td>Tidak Disetuji</td>                                                    
                                                @endif
                                                <td>
                                                    @if (Auth::user()->role_id == 3 && $data->acc == 0)
                                                    <a class="btn btn-sm btn-success" href="/pengajuan-purchase-acc/{{ $item->id }}/1">Terima</a>
                                                    <a class="btn btn-sm btn-warning" href="/pengajuan-purchase-acc/{{ $item->id }}/2">Tolak</a>
                                                    @endif
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

        <!-- EOF MAIN-BODY -->
    </div>
    {{-- <div class="modal fade" id="exampleModalSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form method="post" action="{{ url('pengajuan-purchase/simpan') }}" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Kode</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="kode"
                                                value="{{ $kode }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Inventory List</label>
                                        <div class="col">
                                            {{-- <input type="number" class="form-control" name="id_inventory" value="{{ $inventory->id }}"> --}}
                                            {{-- <select class="form-control selectpicker" id="inventoryList"
                                                name="id_inventory">
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
                                            <input type="text" class="form-control" name="harga" id="harga"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-9">
                                            <input type="hidden" ass="form-control" name="tempat" id="tempat"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">QTY</label>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="qty"
                                                    name="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Sub Total</label>
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="sub_total"
                                                    name="sub_total" readonly>
                                            </div>
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
    </div> --}}
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
