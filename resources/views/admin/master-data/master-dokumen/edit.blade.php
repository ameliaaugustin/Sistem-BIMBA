@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Master Dokumen </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Edit Dokumen</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('m_dokumenupdate', $dokumen_edit->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <label class="col-sm-3 form-label">Edit Jenis Dokumen</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen"
                                placeholder="Jenis Dokumen" type="text"
                                value="{{ old('jenis_dokumen', $dokumen_edit->jenis_dokumen) }}">
                            @error('jenis_dokumen')
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
