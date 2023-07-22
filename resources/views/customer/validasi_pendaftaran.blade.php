@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Dashboard </li>
                </ol>
            </nav>
        </div>
    </div>
    <header class="py-4">
        <div class="container-fluid py-2 text-center">
            <h1 class="h1 fw-normal text-success mb-0"><b>Selamat Datang {{ auth()->user()->fullname }}</b></h1>
        </div>
    </header>
    @if ($pendaftar->status == 'Y')
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-success">Berkas Pendaftaran Telah Diterima</h3>
                    <strong>
                        <h4>Silahkan Memilih Jadwal Pada Menu "PEMILIHAN JADWAL KBM dan PEMBAYARAN"</h4>
                    </strong>
                </div>
            </div>
        </div>
    @elseif($pendaftar->status == 'N')
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-danger">Pendaftaran Ditolak</h3>
                    <strong>
                        <h4>"{{ $pendaftar->keterangan }}"</h4>
                        <p>Silahkan klik Tombol dibawah ini untuk mengecek kembali data anda</p>
                        <a class="btn btn-primary" href="{{ route('get_status', auth()->user()->id) }}">Cek</a>
                    </strong>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Data Formulir Anda Sedang Menunggu Validasi, Pastikan Data Formulir Pendaftaran dan Form Dokumen
                        Sudah <b>
                            DI ISI
                        </b> </h3>
                </div>
            </div>
        </div>
    @endif
@endsection
