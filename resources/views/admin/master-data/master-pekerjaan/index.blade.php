@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Master Pekerjaan </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="tables">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <p>
                            <h3 class="h4 mb-0">Data Master Pekerjaan</h3>
                            </p>
                            <a class="btn btn-primary" href="{{ route('m_pekerjaancreate') }}">Tambah Pekerjaan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-sm mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Nama
                                            </th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($master_pekerjaan as $mp)
                                            <tr>
                                                <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                <td class="text-center">{{ $mp->jenis_pekerjaan }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('m_pekerjaanedit', $mp->id) }}">Edit</a>
                                                    <a onclick="return confirm('Apakah anda yakin, ingin menghapus nama Pekerjaan?')"
                                                        class="btn btn-danger"
                                                        href="{{ route('m_pekerjaandestroy', $mp->id) }}">Delete</a>

                                                </td>

                                            </tr>
                                        @endforeach
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
