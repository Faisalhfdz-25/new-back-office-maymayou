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
    <!-- BOF Basic Datatable -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="caption uppercase">
                        <i class="ti-file"></i> Inventory List
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
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Jenis | Penggunaan | Kelas</th>
                                    <th>Merk</th>
                                    <th>Tempat</th>
                                    <th>Harga Terakhir</th>
                                    <th>Penyaluran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jeniskategori->nama }} | {{ $item->penggunaanproduk->nama }} | {{ $item->kelasproduk->nama }}</td>
                                        <td>{{ $item->merk }}</td>
                                        <td>{{ $item->supplier->nama }} - {{ $item->supplier->alamat }}</td>
                                        <td>
                                            @if ($item->jenis == 9)
                                                <a class="btn btn-sm btn-info text-charcoal" href="/inventory-list/resep/{{ $item->id }}">Resep</a>
                                            @else
                                                {{ $item->harga }}</td>
                                            @endif
                                        <td>
                                            @if ($item->is_produksi == 1)
                                                <a class="btn btn-sm btn-outline-grape btn-round" href="javascript:void(0);">Produksi</a>
                                            @endif
                                            @if ($item->is_toko == 1)
                                                <a class="btn btn-sm btn-outline-lemon btn-round" href="javascript:void(0);">Toko</a>
                                            @endif
                                            @if ($item->is_frozen == 1)
                                                <a class="btn btn-sm btn-outline-azure btn-round" href="javascript:void(0);">Frozen</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning text-charcoal" href="/inventory-list/editview/{{ $item->id }}"><i class="ti-pencil-alt"></i></a>
                                            <a class="btn btn-sm btn-danger text-charcoal" href="javascript:void(0);" onclick="hapus('{{ $item->id }}')"><i class="ti-trash"></i></a>
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
                    <form method="post" action="{{url('inventory-list/simpan')}}" novalidate enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kode</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="kode">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jenis</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="jenis">
                                            @foreach ($jenis as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Penggunaan</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="penggunaan">
                                            @foreach ($penggunaan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kelas</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="kelas">
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Satuan Pengadaan</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="satuan_pengadaan">
                                            <option value="Kg">Kg</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Mili Liter">Mili Liter</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Bottle">Bottle</option>
                                            <option value="Ikat">Ikat</option>
                                            <option value="Renceng">Renceng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">QTY Minimal Pengadaan</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="qty_min_pengadaan">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Satuan Terkecil / Produksi</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="satuan_produksi">
                                            <option value="Kg">Kg</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Mili Liter">Mili Liter</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Bottle">Bottle</option>
                                            <option value="Ikat">Ikat</option>
                                            <option value="Renceng">Renceng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">QTY Minimal Stok</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="qty_min_stok">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Merk</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="merk">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tempat</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="supplier">
                                            @foreach ($tempat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Digunakan Di :</label>
                                    <div class="col">
                                        <div class="form-checkbox">
                                            <label>
                                                <input type="checkbox" name="is_produksi">
                                                <span class="checkmark"><i class="fa fa-check"></i></span>
                                                Produksi
                                            </label>
                                        </div>
                                        <div class="form-checkbox">
                                            <label>
                                                <input type="checkbox" name="is_toko">
                                                <span class="checkmark"><i class="fa fa-check"></i></span>
                                                Toko
                                            </label>
                                        </div>
                                        <div class="form-checkbox">
                                            <label>
                                                <input type="checkbox" name="is_frozen">
                                                <span class="checkmark"><i class="fa fa-check"></i></span>
                                                Frozen
                                            </label>
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
                        url: "{{url('inventory-list/hapus')}}",
                        type: "post",
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                Swal.fire('Berhasil!', 'Data Inventory berhasil dihapus.', 'success');
                                location.reload()
                            } else {
                                Swal.fire('Gagal!', 'Data Inventory gagal dihapus, silahkan refresh halaman ini kemudian coba lagi.', 'error');
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
    @if(session('Save'))
        <script>
            Swal.fire('Berhasil!', 'Data Berhasil Berhasil Disimpan.', 'success');
        </script>
    @endif
@endsection