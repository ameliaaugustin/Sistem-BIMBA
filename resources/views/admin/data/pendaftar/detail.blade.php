@extends('layouts.maindashboard')

@section('container')
    <div class="container">
        {{-- form data siswa --}}
        <div class="bg-gray-200 text-sm">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                        <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active fw-light" aria-current="page">Halaman Detail Pendaftar </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="h4 mb-0 text-center">Detail Data Pendaftar </h3>
                    </div>

                    @include('admin.data.pendaftar.data-diri')

                </div>
            </div>
        </div>

        @include('admin.data.pendaftar.data-orang-tua')

        {{-- Data Dokumen --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-header border-bottom">
                        <h3 class="h4 mb-0">Data Dokumen</h3>
                    </div>

                    <div class="card-body">
                        @if (count($dokumen) > 0)
                            @foreach ($dokumen as $values)
                                <div class="row justifiy-content-between mb-3">
                                    <div class="col-lg-6">
                                        <h5> {{ $values->jenis_dokumen }}
                                        </h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-grid gap-2 justify-content-md-end">
                                            <a target="_blank" href="{{ asset('storage/' . $values->document_name) }}"
                                                class="btn btn-primary">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h5> Tidak ada dokumen yang di upload
                            </h5>
                        @endif

                    </div>

                </div>
            </div>
            {{-- Select Status --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>KONFIRMASI STATUS
                        </h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_data_pendaftar', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-4">
                                <select class="form-select" name="status_select">
                                    <option value="" hidden>Pilih....</option>
                                    <option value="Y">Diterima</option>
                                    <option value="N">Dikembalikan</option>
                                </select>
                            </div>
                            <div class="row mb-4">
                                <textarea class="form-control" name="keterangan" id="" cols="30" rows="5"></textarea>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-primary md-auto">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            klikSosmed()
            klikUserAfiliate()
        });
    </script>

    <script type="text/javascript">
        function klikSosmed() {
            var klik_sosmed = $('#sosmedOptions').val();

            if (klik_sosmed == 'Lainnya') {
                document.getElementById("afliliateFrom").style.display = "block";
            } else {
                document.getElementById("afliliateFrom").style.display = "none";
            }
        }

        function klikUserAfiliate() {
            var afiliateFrom = $('#afliliateFrom').val();

            if (afiliateFrom == 'Lainnya') {
                document.getElementById("elseUserAfiliate").style.display = "block";
            } else {
                document.getElementById("elseUserAfiliate").style.display = "none";

            }
        }
    </script>
@endsection
