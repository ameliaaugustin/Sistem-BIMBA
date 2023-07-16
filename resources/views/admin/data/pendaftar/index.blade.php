@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Data Pendaftar </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- <div class="container-fluid"> --}}
    {{-- <div class="row">
        <a class="btn btn-primary" href="">Tambah</a>

    </div> --}}
    {{-- </div> --}}

    <div class="container-fluid mt-4 mb-3">
        <form action="{{ route('data_pendaftar') }}" method="GET">
            {{-- @csrf --}}
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group rounded">
                        <select class="form-select" name="status">
                            <option value="" hidden>Pilih Status</option>
                            <option value="Y">Diterima</option>
                            <option value="N">Dikembalikan</option>
                        </select>

                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Search Nama..." name="search"
                            value="{{ $search }}" aria-label="Search" aria-describedby="search-addon">
                    </div>

                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <section class="tables">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <h3 class="h4 mb-0">Data Pendaftar</h3>
                                </div>
                                <div class="col-3 text-end">
                                    <div class="mb-2">
                                        {{-- {{ dd($status) }} --}}
                                        {{-- <input type="hidden" name="status"> --}}
                                        @php
                                            if ($status == null) {
                                                $status = 'null';
                                            }
                                        @endphp
                                        <a class="btn btn-warning btn-sm" href="{{ route('cetak_data_pend', $status) }}">
                                            Export</a><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-sm mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Tempat Lahir</th>
                                            <th class="text-center">Tanggal Lahir</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($dt_pendaftar as $dt_pend)
                                            <tr>
                                                <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                <td class="text-start">{{ $dt_pend->nama_lengkap }}</td>
                                                <td class="text-center">{{ $dt_pend->tempat_lahir }}</td>
                                                <td class="text-center">{{ $dt_pend->tanggal_lahir }}</td>
                                                <td class="text-center">
                                                    @if ($dt_pend->jenis_kelamin == 'L')
                                                        <span class="text-success">Laki-laki</span>
                                                    @elseif ($dt_pend->jenis_kelamin == 'P')
                                                        <span class="text-danger">Perempuan</span>
                                                    @else
                                                        <span></span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($dt_pend->status == 'Y')
                                                        <span class="text-success">Diterima</span>
                                                    @elseif ($dt_pend->status == 'N')
                                                        <span class="text-danger">Dikembalikan</span>
                                                    @else
                                                        <span>Menunggu Validasi</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('detail_pendaftar', $dt_pend->id) }}">Detail</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $dt_pendaftar->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
