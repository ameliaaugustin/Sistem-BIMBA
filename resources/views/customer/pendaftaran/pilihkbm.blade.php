@extends('layouts.maindashboard')
@section('container')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="h4 mb-0 text-center">Pemilihan Jadwal Dan Pembayaran</h3>
                </div>
                <div class="card-body">
                    {{-- <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p> --}}
                    <form class="form-horizontal" action="{{ route('saveFormJadwal') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-4 form-label" for="inputHorizontalElTwo"> Pilih Paket <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-select @error('paket') is-invalid @enderror" name="paket"
                                    id="pilih_paket" onchange="getPricePacket()">
                                    <option value=""hidden>Pilih...</option>
                                    @foreach ($m_paket as $paket)
                                        <option value="{{ $paket->id }}">
                                            {{ $paket->jenis_paket }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('paket')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-4 form-label" for="inputHorizontalElTwo"> Pilih Jam Belajar <span
                                    class="text-danger">*</span></label>

                            <div class="col-sm-6">
                                <select class="form-select col-sm-6 @error('jadwal') is-invalid @enderror" name="jadwal"
                                    id="jadwal">
                                    <option value="" hidden>Pilih Jadwal</option>
                                </select>
                                @error('jadwal')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="row gy-2 mb-4">

                            <label class="col-sm-4 form-label">
                                No Rekening
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" value="7390934658 An/ Winda Arie Andriyani"
                                    disabled>
                            </div>
                        </div>

                        <div class="row gy-2 mb-4">
                            <div class="col-lg-12">
                                <div class="row gy-2 mb-4">
                                    @foreach ($item_bayar as $m_i_bayar)
                                        <label class="col-sm-4">
                                            <p class="card-text">{{ $m_i_bayar->nama_item }}</p>
                                        </label>
                                        <label class="col-sm-6">
                                            <input type="text" value="{{ $m_i_bayar->biaya_item }}" disabled>
                                        </label>
                                    @endforeach
                                    <label class="col-sm-4">
                                        <p class="card-text">Harga Paket</p>
                                    </label>
                                    <label class="col-sm-6">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="harga_paket" disabled>
                                            </div>
                                            <div class="col">
                                                / Bulan
                                            </div>
                                        </div>
                                    </label>

                                    <label class="col-sm-4">
                                        <p class="card-text"><strong>Total Bayar </strong></p>
                                    </label>
                                    <label class="col-sm-6">
                                        <input type="text" name="total_bayar" id="total_bayar" readonly>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-4 form-label" for="inputHorizontalElTwo"> Pilih Metode Pembayaran <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-select @error('metode_bayar') is-invalid @enderror" name="metode_bayar"
                                    id="metode_bayar">
                                    <option value="" hidden>Pilih...</option>
                                    <option value="CASH">CASH</option>
                                    <option value="TRANSFER">TRANSFER</option>
                                </select>
                                @error('metode_bayar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row gy-2 mb-4">
                            <label class="col-sm-4 form-label" for="bukti_bayar">
                                Bukti Bayar <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar"
                                    name="bukti_bayar" type="file" disabled>

                                @error('bukti_bayar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>
                                <b> Harap Diperhatikan : </b><br>
                                Uang yang telah dibayarkan tidak dapat diminta kembali.
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 ms-auto">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Pihak Pendaftar/Orang tua/Wali dengan ini menyepakati ketentuan
                        yang telah ditentukan BIMBA Rainbow Kids, diantaranya :</h3>
                </div>
                <div class="card-body">
                    <label>
                        1. Pembayaran Administrasi/Uang Bimbingan bulanan dilunasi paling lambat tanggal 10 setiap
                        bulannya<br>
                        2. Pendaftaran siswa baru yang dilakukan sebelum tanggal 15, maka biaya bimbingan bulanan akan
                        dibebankan secara penuh <br>
                        3. Pendaftaran yang dilakukan setelah tanggal 15, akan dibebankan sebesar 50% dari biaya
                        administrasi/bimbingan bulanan <br>
                        4. Penggantian hari belajar diberikan apabila: <br>
                        ketidak hadiran siswa kurang dari 6 kali pertemuan, dan ketidakhadiran dikarenakan kondisi :<br>
                        a. Siswa berhalangan karena sakit <br>
                        b. Kegiatan belajar diliburkan diluar ketentuan libur bersama<br>
                        5. Penggantian hari gugur apabila, siswa izin lebih dari 6 kali pertemuan<br>
                        6. Pengajuan penggantian hari dapat dilakukan maksimal 1 bulan setelah siswa tidak
                        hadir/diliburkan<br>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#pilih_paket').change(function() {
                var paket = $(this).val();
                if (paket) {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('getJadwal') }}", // Ganti dengan rute yang benar
                        dataType: "json",
                        data: {
                            paket: paket
                        },
                        success: function(data) {
                            var data_jadwal = data.jadwals;
                            console.log(data_jadwal);
                            $('#jadwal').find("option").not(":first").remove();
                            if (data.count_jadwal > 0) {
                                $.each(data_jadwal, function(key, value) {
                                    var hari = value.hari;
                                    var nama_hari = hari.map(h => h.nama_hari).join(
                                        ', ');
                                    $('#jadwal').append(
                                        $("<option>", {
                                            value: value.id_jadwal,
                                            text: nama_hari + " " + value
                                                .sesi_jam
                                        })
                                    )
                                });
                            } else {
                                toastr.warning(
                                    'Jadwal belum tersedia atau sudah penuh, Harap hubungi admin'
                                );
                            }
                        },
                        error: function() {
                            toastr.error('Gagal memuat data jadwal');
                        }
                    });
                }
            });

            $('#metode_bayar').change(function() {
                var metode_bayar = $(this).val();

                if (metode_bayar == 'TRANSFER') {
                    $("#bukti_bayar").prop('disabled', false);
                } else {
                    $("#bukti_bayar").prop('disabled', true);
                }
            });

        });
    </script>

    <script>
        function getPricePacket() {
            var paket = $('#pilih_paket').val();

            $.ajax({
                url: "{{ route('getPrice') }}",
                method: "GET",
                dataType: "JSON",
                data: {
                    paket: paket
                },
                success: function(data) {
                    $('#harga_paket').val(data.biaya_paket);
                    $('#total_bayar').val(data.total_bayar);
                    // toastr(message);
                },
            })

        }
    </script>
@endsection
