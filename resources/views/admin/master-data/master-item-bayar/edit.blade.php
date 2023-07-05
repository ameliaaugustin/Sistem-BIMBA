@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Master Item Bayar </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Update Nama Item Bayar</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('m_itemupdate', $item_edit->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="row">
                        <label class="col-sm-3 form-label">Edit Nama Item</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('nama_item') is-invalid @enderror" name="nama_item"
                                placeholder="Nama Item Bayar" type="text"
                                value="{{ old('nama_item', $item_edit->nama_item) }}">
                            @error('nama_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 form-label">Edit Biaya Item</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('biaya_item') is-invalid @enderror" name="biaya_item"
                                placeholder="Biaya Paket" type="text"
                                value="{{ old('biaya_item', $item_edit->biaya_item) }}">
                            @error('biaya_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="border-bottom my-5 border-gray-200"></div>
                    <div class="row">
                        <div class="col-sm-9 ms-auto">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
