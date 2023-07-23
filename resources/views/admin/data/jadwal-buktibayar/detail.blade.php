@extends('layouts.maindashboard')

@section('container')
    <div class="container">
        {{-- form data siswa --}}
        <div class="bg-gray-200 text-sm">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                        <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active fw-light" aria-current="page">Halaman Detail Jadwal Bukti Bayar
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Data Detail Jadwal Bukti --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-body">

                        <div class="row gy-2 mb-4">
                            <h5 class="card-title">Data Detail Jadwal Bukti Bayar</h5>
                            <div class="col-sm-6">
                                <label>
                                    <p class="card-text">Nama Lengkap</p>
                                    <p class="card-text">Paket</p>
                                    <p class="card-text">Jadwal</p>

                                    <p class="card-text">Total Bayar</p>
                                    <p class="card-text">Bukti Bayar</p>

                                </label>
                            </div>

                            <div class="col-sm-6">
                                <label for="inputHorizontalElOne">
                                    @if ($detail !== null)
                                        <p class="card-text">: {{ $detail->nama_lengkap ?? '' }}</p>
                                        <p class="card-text">: {{ $detail->jenis_paket ?? '' }}</p>
                                        <p class="card-text">:
                                            @foreach ($arr_hari as $hari)
                                                {{ $hari }}
                                            @endforeach
                                            {{ $detail->jam_mulai . '-' . $detail->jam_selesai ?? '' }}
                                        </p>
                                        <p class="card-text">: {{ $total_bayar ?? '' }}</p>
                                        <p class="card-text">:
                                            @if ($detail->metode_bayar == 'CASH')
                                                Cash
                                            @else
                                                <a target="_blank" href="{{ asset('storage/' . $detail['bukti_bayar']) }}"
                                                    class="btn btn-primary">Lihat</a>
                                            @endif
                                        </p>
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- Select Status --}}
            <div class="col-lg-6">
                <div class="card">
                    @if ($detail->status_bayar != 'Y')
                        <div class="card-header">
                            <h5>KONFIRMASI STATUS
                            </h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal"
                                action="{{ route('update_jadwal_buktibayar', $detail->id_jadwal) }}" method="POST">

                                @csrf

                                <div class="row mb-4">
                                    <select class="form-select" name="status_bayar">
                                        <option value="" hidden>Pilih....</option>
                                        <option value="Y">Pembayaran Diterima</option>
                                        <option value="N">Pembayaran Gagal</option>
                                    </select>
                                </div>
                                <div class="row mb-4">
                                    <textarea class="form-control" name="keterangan" cols="30" rows="5"></textarea>
                                </div>

                                <div class="row">
                                    <button type="submit" class="btn btn-primary md-auto">Submit</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-header">
                            <h5 class="text-center text-success">KONFIRMASI STATUS
                            </h5>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
