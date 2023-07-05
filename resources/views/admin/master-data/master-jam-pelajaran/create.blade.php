@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Master Jam Pelajaran </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Tambah Jadwal Pelajaran</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('m_jamsave') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label">Pilih Paket</label>
                        <div class="col-sm-9">
                            <select class=" form-select @error('paket') is-invalid @enderror" name="paket">
                                <option value="">Pilih Paket</option>
                                @foreach ($data_paket as $d_paket)
                                    <option value="{{ $d_paket->id }}">{{ $d_paket->jenis_paket }}</option>
                                @endforeach
                            </select>
                            @error('paket')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label">Pilih Hari</label>
                        <div class="col-sm-9">
                            <select class="js-example-responsive form-select @error('hari') is-invalid @enderror"
                                name="hari[]" multiple="multiple">
                                <option value="">Pilih</option>
                                @foreach ($data_hari as $d_hari)
                                    <option value="{{ $d_hari->id }}">{{ $d_hari->nama_hari }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label">Input Jam Mulai</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('jam_mulai') is-invalid @enderror" name="jam_mulai"
                                placeholder="Jam Mulai" type="time">
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label">Input Jam Selesai</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('jam_selesai') is-invalid @enderror" name="jam_selesai"
                                placeholder="Jam Selesai" type="time">
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="border-bottom my-5 border-gray-200"></div>
                    <div class="row">
                        <div class="col-sm-9 ms-auto">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
