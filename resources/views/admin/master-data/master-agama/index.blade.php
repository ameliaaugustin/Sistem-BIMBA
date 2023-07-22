@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Master Agama </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="tables">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <p>
                            <h3 class="h4 mb-0">Data Master Agama</h3>
                            </p>
                            <a class="btn btn-primary" href="{{ route('m_agamacreate') }}">Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-sm mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Nama Agama</th>
                                            <th class="text-center">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($master_agama as $ma)
                                            <tr>
                                                <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                <td class="text-center">{{ $ma->nama_agama }}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('m_agamaedit', $ma->id) }}">Edit</a>
                                                    <a onclick="return confirm('Apakah anda yakin, ingin menghapus Agama tersebut?');"
                                                        class="btn btn-danger"
                                                        href="{{ route('m_agamadestroy', $ma->id) }}">Delete</a>
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
