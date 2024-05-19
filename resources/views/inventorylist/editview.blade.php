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
                                    <label class="col-md-3 col-form-label">Satuan</label>
                                    <div class="col">
                                        <select class="form-control selectpicker" name="satuan">
                                            <option value="Kg" @if ($data->satuan == "Kg") selected @endif>Kg</option>
                                            <option value="Gram" @if ($data->satuan == "Gram") selected @endif>Gram</option>
                                            <option value="Liter" @if ($data->satuan == "Liter") selected @endif>Liter</option>
                                            <option value="Mili Liter" @if ($data->satuan == "Mili Liter") selected @endif>Mili Liter</option>
                                            <option value="Pack" @if ($data->satuan == "Pack") selected @endif>Pack</option>
                                            <option value="Pcs" @if ($data->satuan == "Pcs") selected @endif>Pcs</option>
                                            <option value="Bottle" @if ($data->satuan == "Bottle") selected @endif>Bottle</option>
                                            <option value="Ikat" @if ($data->satuan == "Ikat") selected @endif>Ikat</option>
                                            <option value="Renceng" @if ($data->satuan == "Renceng") selected @endif>Renceng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">QTY Min</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="qty" value="{{ $data->qty_min }}">
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
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- EOF MAIN-BODY -->

    </div>
@endsection