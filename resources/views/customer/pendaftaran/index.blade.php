@extends('layouts.maindashboard')

@section('container')
    <div class="container">
        {{-- form data siswa --}}
        <div class="bg-gray-200 text-sm">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                        <li class="breadcrumb-item"><a class="fw-light" href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active fw-light" aria-current="page">Halaman Pendaftar </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="h4 mb-0 text-center">Formulir Pendaftaran </h3>
                    </div>
                    <div class="card-body">
                        {{-- <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p> --}}
                        <form class="form-horizontal" action="{{ route('save_form_pendaftaran') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElOne">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('nama_lengkap') is-invalid @enderror"
                                        name="nama_lengkap" type="text"
                                        value="{{ isset($pendaftar) ? $pendaftar->nama_lengkap : (old('nama_lengkap') != '' ? old('nama_lengkap') : '') }}"
                                        placeholder="Nama Lengkap">
                                    @error('nama_lengkap')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Nama Panggilan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('nama_panggilan') is-invalid @enderror"
                                        name="nama_panggilan" type="text" placeholder="Nama Panggilan"
                                        value="{{ isset($pendaftar) ? $pendaftar->nama_panggilan : (old('nama_panggilan') != '' ? old('nama_panggilan') : '') }}">
                                    @error('nama_panggilan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label">Tempat/Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input class="form-control  @error('tempat_lahir') is-invalid @enderror"
                                                name="tempat_lahir" type="text" placeholder="Tempat Lahir"
                                                value="{{ isset($pendaftar) ? $pendaftar->tempat_lahir : (old('tempat_lahir') != '' ? old('tempat_lahir') : '') }}">
                                            @error('tempat_lahir')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control  @error('tanggal_lahir') is-invalid @enderror"
                                                name="tanggal_lahir" type="date" placeholder="Tanggal Lahir"
                                                value="{{ isset($pendaftar) ? $pendaftar->tanggal_lahir : (old('tanggal_lahir') != '' ? old('tanggal_lahir') : '') }}">
                                            @error('tanggal_lahir')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin">
                                        <option value="">Pilih</option>
                                        <option value="L"
                                            {{ isset($pendaftar) ? ($pendaftar->jenis_kelamin == 'L' ? 'selected' : '') : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ isset($pendaftar) ? ($pendaftar->jenis_kelamin == 'P' ? 'selected' : '') : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Asal Sekolah</label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('asal_sekolah') is-invalid @enderror"
                                        name="asal_sekolah" type="text" placeholder="Asal Sekolah"
                                        value="{{ isset($pendaftar) ? $pendaftar->asal_sekolah : (old('asal_sekolah') != '' ? old('asal_sekolah') : '') }}">
                                    @error('asal_sekolah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Anak Ke <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('anak_ke') is-invalid @enderror" name="anak_ke"
                                        type="number" placeholder="Anak Ke"
                                        value="{{ isset($pendaftar) ? $pendaftar->anak_ke : (old('anak_ke') != '' ? old('anak_ke') : '') }}">
                                    @error('anak_ke')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Hobi</label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('hobi') is-invalid @enderror" name="hobi"
                                        type="text" placeholder="Hobi"
                                        value="{{ isset($pendaftar) ? $pendaftar->hobi : (old('hobi') != '' ? old('hobi') : '') }}">
                                    @error('hobi')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Agama <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select @error('agama') is-invalid @enderror" name="agama">
                                        <option value="">Pilih</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama->id }}"
                                                {{ isset($pendaftar) ? ($pendaftar->agama == $agama->id ? 'selected' : '') : '' }}>
                                                {{ $agama->nama_agama }}</option>
                                        @endforeach
                                    </select>
                                    @error('agama')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Apakah siswa memiliki
                                    riwayat
                                    sakit
                                    tertentu/kambuhan? <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('riwayat_sakit') is-invalid @enderror"
                                        name="riwayat_sakit" type="text" placeholder="Iya atau Tidak"
                                        value="{{ isset($pendaftar) ? $pendaftar->riwayat_sakit : (old('riwayat_sakit') != '' ? old('riwayat_sakit') : '') }}">
                                    @error('riwayat_sakit')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Apakah siswa mengkonsumi
                                    obat
                                    tertentu
                                    secara rutin? <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('konsumsi_obat') is-invalid @enderror"
                                        name="konsumsi_obat" type="text" placeholder="Iya atau Tidak"
                                        value="{{ isset($pendaftar) ? $pendaftar->konsumsi_obat : (old('konsumsi_obat') != '' ? old('konsumsi_obat') : '') }}">
                                    @error('konsumsi_obat')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label">Apakah siswa pernah mengikuti les membaca
                                    sebelumnya? <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input class="form-control  @error('pernah_les') is-invalid @enderror"
                                                name="pernah_les" type="text" placeholder="Iya atau Tidak"
                                                value="{{ isset($pendaftar) ? $pendaftar->pernah_les : (old('pernah_les') != '' ? old('pernah_les') : '') }}">
                                            @error('pernah_les')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control  @error('old_nama_lembaga') is-invalid @enderror"
                                                name="old_nama_lembaga" type="text"
                                                placeholder="Jika iya, harap masukkan nama lembaga"
                                                value="{{ isset($pendaftar) ? $pendaftar->old_nama_lembaga : (old('old_nama_lembaga') != '' ? old('old_nama_lembaga') : '') }}">
                                            @error('old_nama_lembaga')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control  @error('old_level_les') is-invalid @enderror"
                                                name="old_level_les" type="text"
                                                placeholder="Masukkan level les terakhir"
                                                value="{{ isset($pendaftar) ? $pendaftar->old_level_les : (old('old_level_les') != '' ? old('old_level_les') : '') }}">
                                            @error('old_level_les')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Alasan siswa keluar/tidak
                                    melanjutkan les tersebut</label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('old_alasan_keluar') is-invalid @enderror"
                                        name="old_alasan_keluar" type="text" placeholder="Berikan alasan"
                                        value="{{ isset($pendaftar) ? $pendaftar->old_alasan_keluar : (old('old_alasan_keluar') != '' ? old('old_alasan_keluar') : '') }}">
                                    @error('old_alasan_keluar')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Dari mana tahu Bimba Rainbow
                                    Kids <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <select class="form-select @error('sosmed_options') is-invalid @enderror"
                                                name="sosmed_options" id="sosmedOptions" onchange="getUserAffiliate()">
                                                <option value="null">Pilih</option>
                                                <option value="Google"
                                                    {{ isset($pendaftar) ? ($pendaftar->sosmed_options == 'Google' ? 'selected' : '') : '' }}>
                                                    Google</option>
                                                <option value="Facebook"
                                                    {{ isset($pendaftar) ? ($pendaftar->sosmed_options == 'Facebook' ? 'selected' : '') : '' }}>
                                                    Facebook</option>
                                                <option value="Instagram"
                                                    {{ isset($pendaftar) ? ($pendaftar->sosmed_options == 'Instagram' ? 'selected' : '') : '' }}>
                                                    Instagram</option>
                                                <option value="Youtube"
                                                    {{ isset($pendaftar) ? ($pendaftar->sosmed_options == 'Youtube' ? 'selected' : '') : '' }}>
                                                    Youtube</option>
                                                <option value="Lainnya"
                                                    {{ isset($pendaftar) ? ($pendaftar->sosmed_options == 'Lainnya' ? 'selected' : '') : '' }}>
                                                    Lainnya</option>
                                            </select>
                                            @error('sosmed_options')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="form-select" name="afiliate_from" id="afliliateFrom"
                                                onchange="affliateElse();" disabled>
                                                <option value="null">Pilih</option>
                                                <option value="Lainnya"
                                                    {{ isset($pendaftar) ? ($pendaftar->user_id_affiliate == 'Lainnya' ? 'selected' : '') : '' }}>
                                                    Lainnya</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ isset($pendaftar) ? ($pendaftar->user_id_affiliate == $user->id ? 'selected' : '') : '' }}>
                                                        {{ $user->fullname }}</option>
                                                @endforeach
                                            </select>
                                            @error('afiliate_from')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="form-control  @error('else_user_afiliate') is-invalid @enderror"
                                                name="else_user_afiliate" type="text" id="elseUserAfiliate"
                                                placeholder="Masukkan nama yang memberitahu"
                                                value="{{ isset($pendaftar) ? $pendaftar->nama_afiliate : (old('nama') != '' ? old('nama') : '') }}"
                                                disabled>
                                            @error('else_user_afiliate')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Alasan mengapa memilih Bimba
                                    Rainbow Kids? <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control  @error('alasan_memilih') is-invalid @enderror"
                                        name="alasan_memilih" type="text" placeholder="Berikan alasan"
                                        value="{{ isset($pendaftar) ? $pendaftar->alasan_memilih : (old('alasan_memilih') != '' ? old('alasan_memilih') : '') }}">
                                    @error('alasan_memilih')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 ms-auto">
                                    <input class="btn btn-primary mb-4" type="submit" value="Submit">
                                    <label class="col-sm-4 form-label" for="inputHorizontalElTwo">Klik Submit
                                        Terlebih
                                        Dahulu Sebelum Melanjutkan Mengisi Data Ayah dan Ibu.</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}

        <div class="row">
            {{-- form data ayah --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="h4 mb-0">Data Ayah</h3>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" action="{{ route('save_form_ayah') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElOne">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah"
                                        type="text" placeholder="Nama Lengkap"
                                        value="{{ isset($pendaftar) ? $pendaftar->nama_ayah : (old('nama_ayah') != '' ? old('nama_ayah') : '') }}">

                                    @error('nama_ayah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label">Tempat/Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control @error('tempat_lahir_ayah') is-invalid @enderror"
                                                name="tempat_lahir_ayah" type="text" placeholder="Tempat Lahir"
                                                value="{{ isset($pendaftar) ? $pendaftar->tempat_lahir_ayah : (old('tempat_lahir_ayah') != '' ? old('tempat_lahir_ayah') : '') }}">
                                            @error('tempat_lahir_ayah')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control @error('tgl_lahir_ayah') is-invalid @enderror"
                                                name="tgl_lahir_ayah" type="date" placeholder="Tanggal Lahir"
                                                value="{{ isset($pendaftar) ? $pendaftar->tgl_lahir_ayah : (old('tgl_lahir_ayah') != '' ? old('tgl_lahir_ayah') : '') }}">
                                            @error('tgl_lahir_ayah')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Pendidikan Terakhir <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                        name="pendidikan_ayah" type="text" placeholder="Pendidikan Terakhir"
                                        value="{{ isset($pendaftar) ? $pendaftar->pendidikan_ayah : (old('pendidikan_ayah') != '' ? old('pendidikan_ayah') : '') }}">
                                    @error('pendidikan_ayah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select @error('pekerjaan_ayah') is-invalid @enderror"
                                        name="pekerjaan_ayah">
                                        <option value="">Pilih</option>
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <option value="{{ $pekerjaan->id }}"
                                                {{ isset($pendaftar) ? ($pendaftar->pekerjaan_ayah == $pekerjaan->id ? 'selected' : '') : '' }}>
                                                {{ $pekerjaan->jenis_pekerjaan }}</option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_ayah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Alamat <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('alamat_ayah') is-invalid @enderror" name="alamat_ayah"
                                        placeholder="Masukkan alamat lengkap" cols="50" rows="3">{{ isset($pendaftar) ? $pendaftar->alamat_ayah : (old('alamat_ayah') != '' ? old('alamat_ayah') : '') }}</textarea>
                                    @error('alamat_ayah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">No. Telepon <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('no_telp_ayah') is-invalid @enderror"
                                        type="number" name="no_telp_ayah" placeholder="No. Telepon Ayah"
                                        value="{{ isset($pendaftar) ? $pendaftar->no_telp_ayah : (old('no_telp_ayah') != '' ? old('no_telp_ayah') : '') }}">
                                    @error('no_telp_ayah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @if ($pendaftar != null)
                                <div class="row">
                                    <div class="col-sm-9 ms-auto">
                                        <input class="btn btn-primary mb-4" type="submit" value="Submit">
                                        <label class="col-sm-7 form-label" for="inputHorizontalElTwo">Klik Submit
                                            Terlebih
                                            Dahulu Sebelum Melanjutkan Mengisi Data Ibu.</label>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            {{--  --}}

            {{-- form data ibu --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="h4 mb-0">Data Ibu</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('save_form_ibu') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElOne">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('nama_ibu') is-invalid @enderror" type="text"
                                        name="nama_ibu" placeholder="Nama Lengkap"
                                        value="{{ isset($pendaftar) ? $pendaftar->nama_ibu : (old('nama_ibu') != '' ? old('nama_ibu') : '') }}">
                                    @error('nama_ibu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label">Tempat/Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control @error('tempat_lahir_ibu') is-invalid @enderror"
                                                type="text" name="tempat_lahir_ibu" placeholder="Tempat Lahir"
                                                value="{{ isset($pendaftar) ? $pendaftar->tempat_lahir_ibu : (old('tempat_lahir_ibu') != '' ? old('tempat_lahir_ibu') : '') }}">
                                            @error('tempat_lahir_ibu')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control @error('tgl_lahir_ibu') is-invalid @enderror"
                                                type="date" name="tgl_lahir_ibu" placeholder="Tanggal Lahir"
                                                value="{{ isset($pendaftar) ? $pendaftar->tgl_lahir_ibu : (old('tgl_lahir_ibu') != '' ? old('tgl_lahir_ibu') : '') }}">
                                            @error('tgl_lahir_ibu')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Pendidikan Terakhir <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                        type="text" name="pendidikan_ibu" placeholder="Pendidikan Terakhir"
                                        value="{{ isset($pendaftar) ? $pendaftar->pendidikan_ibu : (old('pendidikan_ibu') != '' ? old('pendidikan_ibu') : '') }}">
                                    @error('pendidikan_ibu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select @error('pekerjaan_ibu') is-invalid @enderror"
                                        name="pekerjaan_ibu">
                                        <option value="">Pilih</option>
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <option value="{{ $pekerjaan->id }}"
                                                {{ isset($pendaftar) ? ($pendaftar->pekerjaan_ibu == $pekerjaan->id ? 'selected' : '') : '' }}>
                                                {{ $pekerjaan->jenis_pekerjaan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_ibu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Alamat <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('alamat_ibu') is-invalid @enderror" name="alamat_ibu"
                                        placeholder="Masukkan alamat lengkap" cols="50" rows="3">{{ isset($pendaftar) ? $pendaftar->alamat_ibu : (old('alamat_ibu') != '' ? old('alamat_ibu') : '') }}</textarea>
                                    @error('alamat_ibu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHorizontalElTwo">No. Telepon <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('no_telp_ibu') is-invalid @enderror" type="number"
                                        name="no_telp_ibu" placeholder="No. Telp Ibu"
                                        value="{{ isset($pendaftar) ? $pendaftar->no_telp_ibu : (old('no_telp_ibu') != '' ? old('no_telp_ibu') : '') }}">
                                    @error('no_telp_ibu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @if ($pendaftar != null)
                                <div class="row">
                                    <div class="col-sm-9 ms-auto">
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            {{--  --}}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sosmedOptions').change(function() {
                var value = $(this).val();

                if (value == 'Lainnya') {
                    $('#elseUserAfiliate').prop('disabled', false);
                } else {
                    $('#elseUserAfiliate').prop('disabled', true);
                    $('#elseUserAfiliate').val('');
                    $('#afliliateFrom').val('');
                }
            })
        });
    </script>

    <script type="text/javascript">
        function getUserAffiliate() {
            var sosmed_value = $('#sosmedOptions').val();

            if (sosmed_value == 'Lainnya') {
                $('#afliliateFrom').prop('disabled', false);
            } else {
                $('#afliliateFrom').prop('disabled', true);

            }
        }

        function affliateElse() {
            var user_affiliate = $('#afliliateFrom').val();

            if (user_affiliate == 'Lainnya') {
                $('#elseUserAfiliate').prop('disabled', false);
            } else {
                $('#elseUserAfiliate').prop('disabled', true);
                $('#elseUserAfiliate').val('');
            }
        }
    </script>
@endsection
