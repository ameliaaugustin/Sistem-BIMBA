<div class="row">
    {{-- form data ayah --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Data Ayah</h3>
            </div>
            <div class="card-body">

                <div class="row gy-2 mb-4">
                    <label class="col-sm-4">
                        <p class="card-text">Nama Ayah</p>
                        <p class="card-text">Tempat, tanggal lahir</p>
                        <p class="card-text">Pendidikan Ayah</p>
                        <p class="card-text">Pekerjaan Ayah</p>
                        <p class="card-text">Alamat Ayah</p>
                        <p class="card-text">No. Telpon</p>
                    </label>
                    <label class="col-sm-8">
                        @if ($ayah !== null)
                            <p class="card-text">: {{ $ayah->nama_ayah ?? '' }}</p>
                            <p class="card-text">:
                                {{ $ayah->tempat_lahir_ayah ?? '' }},
                                {{ date('d-M-Y', strtotime($ayah->tgl_lahir_ayah ?? '')) }}
                            </p>

                            <p class="card-text">: {{ $ayah->pendidikan_ayah ?? '' }}</p>
                            <p class="card-text">: {{ $ayah->jenis_pekerjaan ?? '' }}</p>
                            <p class="card-text">: {{ $ayah->alamat_ayah ?? '' }}</p>
                            <p class="card-text">: {{ $ayah->no_telp_ayah ?? '' }}

                            </p>
                        @endif
                    </label>
                </div>

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

                <div class="row gy-2 mb-4">
                    <label class="col-sm-4">
                        <p class="card-text">Nama Ibu</p>
                        <p class="card-text">Tempat, tanggal lahir</p>
                        <p class="card-text">Pendidikan Ibu</p>
                        <p class="card-text">Pekerjaan Ibu</p>
                        <p class="card-text">Alamat Ibu</p>
                        <p class="card-text">No. Telpon</p>
                    </label>
                    <label class="col-sm-8">
                        @if ($ibu !== null)
                            <p class="card-text">: {{ $ibu->nama_ibu ?? '' }}</p>
                            <p class="card-text">:
                                {{ $ibu->tempat_lahir_ibu ?? '' }},
                                {{ date('d-M-Y', strtotime($ibu->tgl_lahir_ibu)) ?? '' }}
                            </p>

                            <p class="card-text">: {{ $ibu->pendidikan_ibu ?? '' }}</p>
                            <p class="card-text">: {{ $ibu->jenis_pekerjaan ?? '' }}</p>
                            <p class="card-text">: {{ $ibu->alamat_ibu ?? '' }}</p>
                            <p class="card-text">: {{ $ibu->no_telp_ibu ?? '' }}

                            </p>
                        @endif
                    </label>
                </div>

            </div>
        </div>
    </div>
</div>
{{--  --}}
