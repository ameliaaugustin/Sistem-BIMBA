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

    <header class="py-5">
        <div class="container-fluid text-center">

            <h3 class="gy-4 gy-xl-0  ms-2 h4 text-dark text-uppercase fw-normal"><b>Selamat Datang
                    {{ auth()->user()->fullname }}</b>
            </h3>
        </div>
    </header>
    <section class="py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Count item widget-->
                <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
                    <div class="d-flex">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
                            <use xlink:href="#user-1"> </use>
                        </svg>
                        <div class="ms-2">
                            <h3 class="h4 text-dark text-uppercase fw-normal">Total Pendaftar</h3>
                            <p class="display-6 mb-0">{{ $count_pendaftar }}</p>
                            <p class="text-gray-500 small">Last Register
                                @if ($get_time_pendaftar != null)
                                    {{ $get_time_pendaftar->created_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
                    <div class="d-flex">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
                            <use xlink:href="#survey-1"> </use>
                        </svg>
                        <div class="ms-2">
                            <h3 class="h4 text-dark text-uppercase fw-normal">Pembayaran Berhasil</h3>
                            <p class="display-6 mb-0">{{ $bukti_bayar }}</p>
                            <p class="text-gray-500 small">Last Paid
                                @if ($get_time_bayar != null)
                                    {{ $get_time_bayar->created_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
                    <div class="d-flex">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
                            <use xlink:href="#list-details-1"> </use>
                        </svg>
                        <div class="ms-2">
                            <h3 class="h4 text-dark text-uppercase fw-normal">Total Data Afiliasi</h3>
                            <p class="display-6 mb-0">{{ $count_afiliasi }}</p>
                            <p class="text-gray-500 small">Last Affiliate
                                @if ($get_time_afiliasi != null)
                                    {{ $get_time_afiliasi->created_at->diffforHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                {{-- <!-- Count item widget-->
                <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
                    <div class="d-flex">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
                            <use xlink:href="#numbers-1"> </use>
                        </svg>
                        <div class="ms-2">
                            <h3 class="h4 text-dark text-uppercase fw-normal">New Invoices</h3>
                            <p class="text-gray-500 small">Last 2 days</p>
                            <p class="display-6 mb-0">123</p>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
                    <div class="d-flex">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
                            <use xlink:href="#literature-1"> </use>
                        </svg>
                        <div class="ms-2">
                            <h3 class="h4 text-dark text-uppercase fw-normal">Open Cases</h3>
                            <p class="text-gray-500 small">Last 3 months</p>
                            <p class="display-6 mb-0">92</p>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
                    <div class="d-flex">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
                            <use xlink:href="#paper-stack-1"> </use>
                        </svg>
                        <div class="ms-2">
                            <h3 class="h4 text-dark text-uppercase fw-normal">New Cases</h3>
                            <p class="text-gray-500 small">Last 7 days</p>
                            <p class="display-6 mb-0">70</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection
