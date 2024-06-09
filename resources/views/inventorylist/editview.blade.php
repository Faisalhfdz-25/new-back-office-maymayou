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
                    <form method="post" action="{{url('inventory-list/update')}}" novalidate enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kode</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="hidden" class="form-control" name="id" value="{{ $data->id }}">
                                            <input type="text" class="form-control" name="kode" value="{{ $data->kode }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jenis</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="jenis">
                                            @foreach ($jenis as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $data->jenis) selected @endif>{{ $item->nama }} - {{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Penggunaan</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="penggunaan">
                                            @foreach ($penggunaan as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $data->penggunaan) selected @endif>{{ $item->nama }} - {{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kelas</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="kelas">
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $data->kelas) selected @endif>{{ $item->nama }} - {{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Satuan Pengadaan</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="satuan_pengadaan">
                                            <option value="Kg" @if ($data->satuan_pengadaan == "Kg") selected @endif>Kg</option>
                                            <option value="Gram" @if ($data->satuan_pengadaan == "Gram") selected @endif>Gram</option>
                                            <option value="Liter" @if ($data->satuan_pengadaan == "Liter") selected @endif>Liter</option>
                                            <option value="Mili Liter" @if ($data->satuan_pengadaan == "Mili Liter") selected @endif>Mili Liter</option>
                                            <option value="Pack" @if ($data->satuan_pengadaan == "Pack") selected @endif>Pack</option>
                                            <option value="Pcs" @if ($data->satuan_pengadaan == "Pcs") selected @endif>Pcs</option>
                                            <option value="Bottle" @if ($data->satuan_pengadaan == "Bottle") selected @endif>Bottle</option>
                                            <option value="Ikat" @if ($data->satuan_pengadaan == "Ikat") selected @endif>Ikat</option>
                                            <option value="Renceng" @if ($data->satuan_pengadaan == "Renceng") selected @endif>Renceng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">QTY Minimal Pengadaan</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="qty_min_pengadaan" value="{{ $data->qty_min_pengadaan }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Satuan Terkecil / Produksi</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="satuan_produksi">
                                            <option value="Kg" @if ($data->satuan_produksi == "Kg") selected @endif>Kg</option>
                                            <option value="Gram" @if ($data->satuan_produksi == "Gram") selected @endif>Gram</option>
                                            <option value="Liter" @if ($data->satuan_produksi == "Liter") selected @endif>Liter</option>
                                            <option value="Mili Liter" @if ($data->satuan_produksi == "Mili Liter") selected @endif>Mili Liter</option>
                                            <option value="Pack" @if ($data->satuan_produksi == "Pack") selected @endif>Pack</option>
                                            <option value="Pcs" @if ($data->satuan_produksi == "Pcs") selected @endif>Pcs</option>
                                            <option value="Bottle" @if ($data->satuan_produksi == "Bottle") selected @endif>Bottle</option>
                                            <option value="Ikat" @if ($data->satuan_produksi == "Ikat") selected @endif>Ikat</option>
                                            <option value="Renceng" @if ($data->satuan_produksi == "Renceng") selected @endif>Renceng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">QTY Minimal Stok</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="qty_min_stok" value="{{ $data->qty_min_stok }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Merk</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="merk" value="{{ $data->merk }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Harga</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="harga" value="{{ $data->harga }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tempat</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="supplier">
                                            @foreach ($tempat as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $data->tempat) selected @endif>{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Digunakan Di :</label>
                                    <div class="col">
                                        <div class="form-checkbox">
                                            <label>
                                                <input type="checkbox" name="is_produksi" @if ($data->is_produksi == 1) checked @endif>
                                                <span class="checkmark"><i class="fa fa-check"></i></span>
                                                Produksi
                                            </label>
                                        </div>
                                        <div class="form-checkbox">
                                            <label>
                                                <input type="checkbox" name="is_toko" @if ($data->is_toko == 1) checked @endif>
                                                <span class="checkmark"><i class="fa fa-check"></i></span>
                                                Toko
                                            </label>
                                        </div>
                                        <div class="form-checkbox">
                                            <label>
                                                <input type="checkbox" name="is_frozen" @if ($data->is_frozen == 1) checked @endif>
                                                <span class="checkmark"><i class="fa fa-check"></i></span>
                                                Frozen
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Rumus Bagi</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="rumus_bagi" value="{{ $data->rumus_bagi }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection