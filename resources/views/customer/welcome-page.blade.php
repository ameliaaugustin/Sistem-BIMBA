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
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Silahkan Lakukan Pandaftaran dan Upload Dokumen, Dengan Mengisi Form Pendaftaran Terlebih Dahulu, </h3>
                <h3>Kemudian Mengisi Form Dokumen Pada Menu Navbar di Samping!!! </h3>
            </div>
        </div>
    </div>

    {{-- @if (auth()->user()->user_role_id === 3)
        @if (isset($pendaftar))
            @include('customer.validasi_pendaftaran')
        @else
            @include('customer.welcome-page')
        @endif
        {{-- @include('customer.validasi_pembayaran') --}}
    {{-- @endif  --}}
@endsection
