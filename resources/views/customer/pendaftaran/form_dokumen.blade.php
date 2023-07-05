@extends('layouts.maindashboard')
@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Halaman Pendaftar </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        {{-- <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p> --}}
                        <h3 class="h4 mb-0 text-center">Form Upload Dokumen </h3>
                        <form class="form-horizontal" action="{{ route('save_form_dokumen') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @foreach ($dokumens as $dokumen)
                                <div class="border-bottom my-5 border-gray-200"></div>
                                <div class="row gy-2 mb-4">
                                    <label class="col-sm-3 form-label" for="dokumen">
                                        {{ $dokumen->jenis_dokumen }}
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error($dokumen->nama_request) is-invalid @enderror"
                                            id="dokumen" name="{{ $dokumen->nama_request }}" type="file">

                                        @error($dokumen->nama_request)
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @if (count($arr_file_exists) > 0)
                                        @if (isset($arr_file_exists[$dokumen->id]))
                                            <a target="_blank"
                                                href="{{ asset('storage/' . $arr_file_exists[$dokumen->id]) }}"
                                                class="col-sm-1 btn btn-primary btn-sm">Lihat</a>
                                        @endif
                                    @endif
                                </div>
                            @endforeach

                            <div class="row">
                                <div class="col-sm-9 mt-3 ms-auto">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
