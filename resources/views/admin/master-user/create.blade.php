@extends('layouts.maindashboard')

@section('container')
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Data User Admin </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Tambah User Admin</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('m_usersave') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <label class="col-sm-3 form-label">Input Nama User</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('nama_user') is-invalid @enderror" name="nama_user"
                                placeholder="Nama User" type="text">
                            @error('nama_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label class="col-sm-3 form-label">Pilih User Role</label>
                        <div class="col-sm-9">
                            <select class="form-select @error('user_role_id') is-invalid @enderror" name="user_role_id">
                                <option value="">Pilih</option>
                                @foreach ($user_role as $role_id)
                                    <option value="{{ $role_id->id }}">{{ $role_id->role_name }}</option>
                                @endforeach
                            </select>
                            @error('user_role_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <label class="col-sm-3 form-label">Input Username</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('username') is-invalid @enderror" name="username"
                                placeholder="Username" type="text">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="col-sm-3 form-label">Input Email</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Email" type="text">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="col-sm-3 form-label">Input Password</label>
                        <div class="col-sm-9">
                            <input class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Password" type="text">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="border-bottom my-5 border-gray-200"></div>
                    <div class="row">
                        <div class="col-sm-9 ms-auto">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
