@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Data Affiliasi </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid mt-4 mb-3">
        <form action="" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group rounded">
                        <select class="form-select" name="role_search">
                            <option value="" hidden>Pilih Nama Role</option>
                            @foreach ($roles as $value)
                                <option value="{{ $value->id }}">{{ $value->role_name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Search Nama User..."
                            name="user_search" value="" aria-label="Search" aria-describedby="search-addon">
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
                                    <h3 class="h4 mb-0">Data Affiliasi</h3>
                                </div>
                                <div class="col-3 text-end">
                                    <div class="mb-2">
                                        @php
                                            if ($role_search == null) {
                                                $role_search = 'null';
                                            }
                                        @endphp
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('cetak_data_affiliasi', $role_search) }}">
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
                                            <th class="text-center">Nama Pendaftar</th>
                                            <th class="text-center">Tanggal Daftar</th>
                                            <th class="text-center">Affiliasi Dari</th>
                                            <th class="text-center">Role Affiliasi</th>
                                            <th class="text-center">Harga Affiliasi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                            $harga_affiliasi = 25000;
                                        @endphp
                                        @foreach ($data_affiliasi as $dt_affiliasi)
                                            @php
                                                $role_lainnya = 'Lainnya';
                                            @endphp
                                            <tr>
                                                <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                <td class="text-center">{{ $dt_affiliasi->nama_lengkap }}</td>
                                                <td class="text-center">
                                                    {{ date('d-M-Y', strtotime($dt_affiliasi->created_at)) }}</td>
                                                <td class="text-center">
                                                    {{ $dt_affiliasi->nama_afiliate ?? $dt_affiliasi->sosmed_options }}</td>
                                                <td class="text-center">{{ $dt_affiliasi->role_name ?? $role_lainnya }}</td>
                                                <td class="text-center">{{ $harga_affiliasi }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data_affiliasi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
