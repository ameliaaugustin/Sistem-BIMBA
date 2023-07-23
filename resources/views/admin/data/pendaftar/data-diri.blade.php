<div class="row">
    <div class="col-sm-6">
        <div class="card">

            <div class="card-body">
                <img src="{{ asset('assets') }}/img/logobimba.png" alt="person">
                <div class="row gy-2 mb-4">
                    <h5 class="card-title">Data Diri</h5>
                    <div class="col-sm-6">
                        <label>
                            <p class="card-text">Nama Lengkap</p>
                            <p class="card-text">Nama Panggilan</p>
                            <p class="card-text">Tempat,tanggal lahir</p>
                            <p class="card-text">Jenis Kelamin</p>
                            <p class="card-text">Asal Sekolah</p>
                            <p class="card-text">Anak Ke-</p>
                            <p class="card-text">Hobi</p>
                            <p class="card-text">Agama</p>
                        </label>
                    </div>

                    <div class="col-sm-6">
                        <label for="inputHorizontalElOne">
                            @if ($pendaftar !== null)

                                <p class="card-text">: {{ $pendaftar->nama_lengkap ?? '' }}</p>
                                <p class="card-text">: {{ $pendaftar->nama_panggilan ?? '' }}</p>
                                <p class="card-text">:
                                    {{ $pendaftar->tempat_lahir ?? '' }},
                                    {{ date('d-M-Y', strtotime($pendaftar->tanggal_lahir)) ?? '' }}
                                </p>
                                <p class="card-text">:
                                    @if ($pendaftar->jenis_kelamin == 'L')
                                        <span class="text-success">Laki-laki</span>
                                    @elseif ($pendaftar->jenis_kelamin == 'P')
                                        <span class="text-danger">Perempuan</span>
                                    @else
                                        <span></span>
                                    @endif
                                </p>
                                <p class="card-text">: {{ $pendaftar->asal_sekolah ?? '' }}</p>
                                <p class="card-text">: {{ $pendaftar->anak_ke ?? '' }}</p>
                                <p class="card-text">: {{ $pendaftar->hobi ?? '' }}</p>
                                <p class="card-text">: {{ $pendaftar->nama_agama ?? '' }}

                                </p>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body py-5">
                <h5 class="card-title">Jawaban Pertanyaan</h5>
                @if ($pendaftar !== null)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Apakah siswa memiliki riwayat sakit tertentu/kambuhan? <p
                                class="card-text">: {{ $pendaftar->riwayat_sakit ?? '' }}</p>
                        </li>

                        <li class="list-group-item">Apakah siswa mengkonsumi obat tertentu secara rutin? <p
                                class="card-text">: {{ $pendaftar->konsumsi_obat ?? '' }}</p>
                        </li>

                        <li class="list-group-item">Apakah siswa pernah mengikuti les membaca sebelumnya? <p
                                class="card-text">: {{ $pendaftar->pernah_les ?? '' }}</p>
                        </li>
                        <li class="list-group-item">Alasan siswa keluar/tidak melanjutkan les tersebut? <p
                                class="card-text">: {{ $pendaftar->old_alasan_keluar ?? '' }}</p>
                        </li>
                        <li class="list-group-item">Dari mana tahu Bimba Rainbow Kids? <p class="card-text">:
                                @if ($pendaftar->sosmed_options == 'Lainnya')
                                    {{ $pendaftar->nama_afiliate }}
                                @else
                                    {{ $pendaftar->sosmed_options }}
                                @endif
                                @if ($pendaftar->fullname == 'Lainnya')
                                    {{ $pendaftar->nama_afiliate }}
                                @endif

                            </p>
                        </li>
                        <li class="list-group-item">Alasan mengapa memilih Bimba Rainbow Kids? <p class="card-text">:
                                {{ $pendaftar->alasan_memilih ?? '' }}</p>
                        </li>

                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
