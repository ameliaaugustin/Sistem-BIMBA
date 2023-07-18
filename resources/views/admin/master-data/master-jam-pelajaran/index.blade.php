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

    <div class="container-fluid mt-4 mb-3">
        <form action="" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group rounded">
                        <select class="form-select" name="jenis_paket">
                            <option hidden>Pilih Jenis Paket</option>
                            @foreach ($paket as $value)
                                <option value="{{ $value->id }}">{{ $value->jenis_paket }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a class="btn btn-warning" href="{{ route('m_jam') }}">Reset</a>
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
                                    <p>
                                    <h3 class="h4 mb-0">Master Jam Pelajaran</h3>
                                    </p>
                                </div>
                                <div class="col text-end">
                                    <a class="btn btn-primary" href="{{ route('m_jamcreate') }}">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-sm mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Jenis Paket</th>
                                            <th class="text-center">Jadwal Hari</th>
                                            <th class="text-center">Jam Pelajaran</th>
                                            <th class="text-center">Status Penuh</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @isset($master_jam_pel)
                                            @foreach ($jadwals as $jadwal)
                                                <tr>
                                                    <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                    <td class="text-center">{{ $jadwal['jenis_paket'] }}</td>
                                                    <td class="text-center">

                                                        @foreach ($jadwal['hari'] as $hari)
                                                            {{ $hari['nama_hari'] }}
                                                        @endforeach

                                                    </td>
                                                    <td class="text-center">{{ $jadwal['sesi_jam'] }}</td>
                                                    <td class="text-center" style="width: 15%">

                                                        <div class="dropdown">
                                                            <a class="btn btn-light dropdown-toggle" href="#"
                                                                role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                @if ($jadwal['status_penuh'] == 'Y')
                                                                    Penuh
                                                                @elseif($jadwal['status_penuh'] == 'N')
                                                                    Tidak Penuh
                                                                @else
                                                                    Pilih Status
                                                                @endif
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('m_jamstatus', ['id' => $jadwal['id'], 'status' => 'Y']) }}">Penuh</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('m_jamstatus', ['id' => $jadwal['id'], 'status' => 'N']) }}">Tidak
                                                                        Penuh</a></li>

                                                            </ul>
                                                        </div>

                                                    </td>
                                                    <td class="text-center" style="width: 15%">
                                                        <a class="btn btn-primary"
                                                            href="{{ route('m_jamedit', $jadwal['id']) }}">Edit</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
