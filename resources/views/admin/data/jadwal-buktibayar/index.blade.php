@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Data Jadwal Bukti Pembayaran </li>
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
        <form action="" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group rounded">
                        <select class="form-select" name="status_bayar">
                            <option value="" hidden>Pilih Status</option>
                            <option value="Y">Pembayaran Diterima</option>
                            <option value="N">Pembayaran Gagal</option>
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
                                    <h3 class="h4 mb-0">Data Jadwal Bukti Bayar</h3>
                                </div>
                                <div class="col-3 text-end">
                                    <div class="mb-2">
                                        @php
                                            if ($status_bayar == null) {
                                                $status_bayar = 'null';
                                            }
                                        @endphp
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('cetak_data_jadwalbuktibayar', $status_bayar) }}">
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
                                            <th class="text-center">Paket</th>
                                            <th class="text-center">Jadwal</th>
                                            <th class="text-center">Total Bayar</th>
                                            <th class="text-center">Status Bayar</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($jadwals as $jadwal)
                                            <tr>
                                                <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                <td class="text-center">{{ $jadwal['nama_lengkap'] }}</td>
                                                <td class="text-center">{{ $jadwal['jenis_paket'] }}</td>
                                                <td class="text-center">
                                                    @foreach ($jadwal['hari'] as $hari)
                                                        {{ $hari['nama_hari'] }}
                                                    @endforeach
                                                    {{ $jadwal['sesi_jam'] }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $jadwal['total_biaya'] }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($jadwal['status_bayar'] == 'Y')
                                                        <span class="text-success">Pembayaran Diterima</span>
                                                    @elseif ($jadwal['status_bayar'] == 'N')
                                                        <span class="text-danger">Pembayaran Gagal</span>
                                                    @else
                                                        <span>Menunggu Validasi</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if ($jadwal['status_bayar'] != 'Y')
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('detail_jadwal_buktibayar', $jadwal['id_jadwal']) }}">Detail</a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data_pendaftar->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
