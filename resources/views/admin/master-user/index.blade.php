@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Master User Admin </li>
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
                            <h3 class="h4 mb-0">Manajemen User Admin dan Super Admin</h3>
                            </p>
                            <a class="btn btn-primary" href="{{ route('m_usercreate') }}">Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-sm mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">User Role</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($user as $dt_user)
                                            <tr>
                                                <td colspan="1" style="width: 5%">{{ $count++ }}</td>
                                                <td class="text-center">{{ $dt_user->fullname }}</td>
                                                <td class="text-center">{{ $dt_user->role_name }}</td>
                                                <td class="text-center">{{ $dt_user->username }}</td>
                                                <td class="text-center">{{ $dt_user->email }}</td>
                                                <td class="text-center text-sm mb-0">
                                                    <a class="btn btn-primary text-center"
                                                        href="{{ route('m_useredit', $dt_user->user_id) }}">Edit</a>

                                                    <a onclick="return confirm('Apakah kamu yakin, ingin menghapus akun tersebut?');"
                                                        class="btn btn-danger text-center"
                                                        href="{{ route('m_userdestroy', $dt_user->user_id) }}">Delete</a>
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
