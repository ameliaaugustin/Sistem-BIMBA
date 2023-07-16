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
            <h1 class="h3 fw-normal mb-0"><b>Hallo {{ auth()->user()->fullname }}</b></h1>
        </div>
    </header>
    @if ($jadwal->status_bayar == 'Y')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        <h3 class="text-success"><b>Selamat Bergabung bersama BIMBA Rainbow Kids </b>
                        </h3>
                        <p>Berikut Data Jadwal Anda</p>
                    </div>
                </div>

            </div>
        </div>
        <section class="tables">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-sm mb-0 table-striped">

                                            <tbody>
                                                <tr>
                                                    <td class="text-right">Nama Lengkap</td>
                                                    <td class="text-right">{{ $jadwal->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Paket Dipilih</td>
                                                    <td class="text-right">{{ $jadwal->jenis_paket }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Jadwal</td>
                                                    <td class="text-right">
                                                        @foreach ($hari as $h)
                                                            {{ $h['nama_hari'] }}
                                                        @endforeach
                                                        {{ $jadwal->jam_mulai }}-{{ $jadwal->jam_selesai }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Total Bayar</td>
                                                    <td class="text-right">
                                                        {{ $total }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Status Pembayaran</td>
                                                    <td class="text-right">
                                                        @if ($jadwal->status_bayar == 'Y')
                                                            <span class="text-success">Pembayaran Diterima</span>
                                                        @elseif ($jadwal->status_bayar == 'N')
                                                            <span class="text-danger">Pembayaran Gagal</span>
                                                        @else
                                                            <span>Menunggu Validasi</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Keterangan</td>
                                                    <td class="text-right">
                                                        {{ $jadwal->keterangan }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @elseif ($jadwal->status_bayar == 'N')
        <div class="container">
            <div class="card ">
                <div class="text-center">
                    <h3 class="text-danger"><b> Pembayaran Anda Gagal </b></h3>
                    <h4><b>"{{ $jadwal->keterangan }}"</b> </h4>
                    <p>Silahkan Klik tombol dibawah ini untuk cek jadwal dan pembayaran anda</p>
                    <a class="btn btn-primary" href="{{ route('get_status_pembayaran', auth()->user()->id) }}">Cek</a>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h2><b>Status Pembayaran Anda Sedang Di Validasi, Harap Menunggu Notifikasi di Halaman Home atau Nomor
                            Anda Akan Dihubungi
                            Oleh Pihak Admin.</b></h2>
                    <h2><b>Apabila Pembayaran Secara 'CASH' Silahkan Kunjungi Alamat BIMBA Rainbow Kids Muktiwari, Pada MAPS
                            Di Bawah ini</b></h2>
                </div>
            </div>
        </div>
        <section class="tables">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3950669607316!2d107.08873901476905!3d-6.211512695503429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698f182e3aa36f%3A0x121e3a0d633b304b!2sBimba%20Rainbow%20Kids%20Muktiwari!5e0!3m2!1sen!2sid!4v1688178631011!5m2!1sen!2sid"
                                            width="600" height="450" style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@endsection
