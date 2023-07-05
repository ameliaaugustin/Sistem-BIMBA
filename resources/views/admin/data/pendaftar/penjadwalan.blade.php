@extends('layouts.maindashboard')
@section('container')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="h4 mb-0 text-center">Pemilihan Jadwal KBM Yang Tersedia </h3>
                </div>
                <div class="card-body">
                    {{-- <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p> --}}
                    <form class="form-horizontal" action="" method="POST">
                        @csrf

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-3 form-label" for="inputHorizontalElTwo"> Siswa Mulai Aktif Masuk <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control  @error('') is-invalid @enderror" name="" type="text"
                                    placeholder="Ketik Tanggal dan Bulan yang diinginkan" {{-- value="{{ old('') ?? $-> }}" --}}>
                                @error('')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-3 form-label" for="inputHorizontalElTwo"> Pilih Hari Belajar <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select @error('') is-invalid @enderror" name="">
                                    <option value="">Pilih</option>

                                    <option value="">Looping nanti
                                    </option>

                                </select>
                                @error('')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Pilih Waktu Belajar <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select @error('') is-invalid @enderror" name="">
                                    <option value="">Pilih</option>

                                    <option value="">Looping nanti
                                    </option>

                                </select>
                                @error('')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-9 ms-auto">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
