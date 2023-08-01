<?php

namespace App\Http\Controllers\pendaftar\form_pendaftaran;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\admin\master_data\MasterAgamaModel;
use App\Models\admin\master_data\MasterPekerjaanModel;
use App\Models\pendaftar\form_pendaftaran\AfiliasiModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranIbuModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranAyahModel;
use App\Http\Requests\pendaftar\form_pendaftaran\FormIbuRequest;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;
use App\Http\Requests\pendaftar\form_pendaftaran\FormAyahRequest;
use App\Http\Requests\pendaftar\form_pendaftaran\FormDokumenRequest;
use App\Http\Requests\pendaftar\form_pendaftaran\FormPendaftarRequest;
use App\Models\admin\master_data\MasterDokumenModel;
use App\Models\pendaftar\form_pendaftaran\FormDokumenModel;

use function GuzzleHttp\Promise\all;

class PendaftaranSiswaController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('user_role_id', '!=', 3)->get();
        $data['agamas'] = MasterAgamaModel::all();
        $data['afiliate'] = AfiliasiModel::all();
        $data['pendaftar'] = PendaftaranSiswaModel::where('dt_pendaftar.user_id', auth()->user()->id)
            ->leftjoin('m_agama', 'dt_pendaftar.agama', 'm_agama.id')
            ->leftjoin('dt_ibu', 'dt_pendaftar.id', 'dt_ibu.id_pendaftar')
            ->leftjoin('dt_ayah', 'dt_pendaftar.id', 'dt_ayah.id_pendaftar')
            ->leftjoin('dt_afiliasi', 'dt_pendaftar.id', 'dt_afiliasi.id_pendaftar')
            ->leftjoin('users', 'dt_pendaftar.user_id', 'users.id')
            ->first();

        $data['pekerjaans'] = MasterPekerjaanModel::all();

        return view('customer.pendaftaran.index', $data);
    }

    public function saveForm(FormPendaftarRequest $req)
    {
        $user = auth()->user()->id;

        try {
            $upsert = PendaftaranSiswaModel::updateOrCreate(
                [
                    'user_id' => $user
                ],
                [
                    'nama_lengkap' => $req->nama_lengkap,
                    'nama_panggilan' => $req->nama_panggilan,
                    'tempat_lahir' => $req->tempat_lahir,
                    'tanggal_lahir' => $req->tanggal_lahir,
                    'jenis_kelamin' => $req->jenis_kelamin,
                    'asal_sekolah' => $req->asal_sekolah,
                    'anak_ke' => $req->anak_ke,
                    'hobi' => $req->hobi,
                    'agama' => $req->agama,
                    'riwayat_sakit' => $req->riwayat_sakit,
                    'konsumsi_obat' => $req->konsumsi_obat,
                    'pernah_les' => $req->pernah_les,
                    'old_nama_lembaga' => $req->old_nama_lembaga,
                    'old_level_les' => $req->old_level_les,
                    'old_alasan_keluar' => $req->old_alasan_keluar,
                    'alasan_memilih' => $req->alasan_memilih
                ]
            );

            // get pendaftar
            $pendaftar =  PendaftaranSiswaModel::where('user_id', $user)->first();


            if ($req->sosmed_options == 'Lainnya') {
                if ($req->afiliate_from == 'Lainnya') {
                    $upsert = AfiliasiModel::updateOrCreate(
                        [
                            'id_pendaftar' => $pendaftar->id
                        ],
                        [
                            'sosmed_options' => $req->sosmed_options,
                            'user_id_affiliate' => $req->afiliate_from,
                            'nama_afiliate' => $req->else_user_afiliate,
                        ]
                    );
                } else {
                    $user_afiliate = User::find($req->afiliate_from);

                    $upsert = AfiliasiModel::updateOrCreate(
                        [
                            'id_pendaftar' => $pendaftar->id
                        ],
                        [
                            'sosmed_options' => $req->sosmed_options,
                            'user_id_affiliate' => $req->afiliate_from,
                            'nama_afiliate' => $user_afiliate->fullname,
                        ]
                    );
                }
            } else {
                $upsert = AfiliasiModel::updateOrCreate(
                    [
                        'id_pendaftar' => $pendaftar->id
                    ],
                    [
                        'sosmed_options' => $req->sosmed_options,
                        'user_id_affiliate' => null,
                        'nama_afiliate' => null,
                    ]
                );
            }

            Toastr::success('Data Sudah Tersimpan', 'Berhasil');
            return back();
        } catch (\Throwable $th) {
            Toastr::error('Terjadi Kesalahan Pada Saat Menyimpan Data,  Isi Data Dengan Benar', 'Gagal');
            return back();
        }
    }

    public function saveFormayah(FormAyahRequest $req)
    {
        $user = auth()->user()->id;
        $pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);
        try {

            $upsert_ayah = PendaftaranAyahModel::updateOrCreate(
                [
                    'id_pendaftar' => $pendaftar->id
                ],
                [
                    'nama_ayah' => $req->nama_ayah,
                    'tempat_lahir_ayah' => $req->tempat_lahir_ayah,
                    'tgl_lahir_ayah' => $req->tgl_lahir_ayah,
                    'pendidikan_ayah' => $req->pendidikan_ayah,
                    'pekerjaan_ayah' => $req->pekerjaan_ayah,
                    'alamat_ayah' => $req->alamat_ayah,
                    'no_telp_ayah' => $req->no_telp_ayah,

                ]
            );



            Toastr::success('Data Ayah Sudah Tersimpan', 'Berhasil');
            return back();
        } catch (\Throwable $th) {
            Toastr::error('Terjadi Kesalahan Pada Saat Menyimpan Data, Mohon Isi Data Dengan Benar', 'Gagal');
            return back();
        }
    }

    public function saveFormibu(FormIbuRequest $req)
    {
        $user = auth()->user()->id;
        $pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);

        $form_ayah = PendaftaranAyahModel::where('id_pendaftar', $pendaftar->id)->first();
        if ($form_ayah == null) {
            Toastr::warning('Silahkan isi FORMULIR Ayah terlebih dahulu', 'Maaf');
            return redirect('/form-pendaftaran');
        }
        try {

            $upsert_ibu = PendaftaranIbuModel::updateOrCreate(
                [
                    'id_pendaftar' => $pendaftar->id
                ],
                [
                    'nama_ibu' => $req->nama_ibu,
                    'tempat_lahir_ibu' => $req->tempat_lahir_ibu,
                    'tgl_lahir_ibu' => $req->tgl_lahir_ibu,
                    'pendidikan_ibu' => $req->pendidikan_ibu,
                    'pekerjaan_ibu' => $req->pekerjaan_ibu,
                    'alamat_ibu' => $req->alamat_ibu,
                    'no_telp_ibu' => $req->no_telp_ibu,
                ]
            );
            Toastr::success('Data Ibu Sudah Tersimpan, Selanjutnya Silahkan Isi Form Dokumen', 'Berhasil');
            return redirect('/form-dokumen');
        } catch (\Throwable $th) {
            Toastr::error('Terjadi Kesalahan Pada Saat Menyimpan Data, Mohon Isi Data Dengan Benar', 'Gagal');
            return back();
        }
    }
    public function formDokumen()
    {
        $user = auth()->user()->id;


        $id_pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);
        // dd($id_pendaftar);

        if ($id_pendaftar == null) {
            Toastr::warning('Silahkan isi FORMULIR PENDAFTARAN terlebih dahulu', 'Maaf');
            return redirect('/form-pendaftaran');
        }

        $form_ayah = PendaftaranAyahModel::where('id_pendaftar', $id_pendaftar->id)->first();
        if ($form_ayah == null) {
            Toastr::warning('Silahkan isi FORMULIR Ayah terlebih dahulu', 'Maaf');
            return redirect('/form-pendaftaran');
        }

        $form_ibu = PendaftaranIbuModel::where('id_pendaftar', $id_pendaftar->id)->first();
        if ($form_ibu == null) {
            Toastr::warning('Silahkan isi FORMULIR Ibu terlebih dahulu', 'Maaf');
            return redirect('/form-pendaftaran');
        }

        $dokumens = MasterDokumenModel::all();

        $docs_uploaded = FormDokumenModel::where('id_pendaftar', $id_pendaftar->id)->get();

        $arr_file_exists = [];
        if (count($docs_uploaded) > 0) {
            foreach ($docs_uploaded as $key => $value) {
                $arr_file_exists[$value->id_m_dokumen] = $value->document_name;
            }
        }

        return view('customer.pendaftaran.form_dokumen', compact('dokumens', 'docs_uploaded', 'arr_file_exists'));
    }

    public function saveformDokumen(FormDokumenRequest $req)
    {

        $user = auth()->user()->id;

        $request = array_keys($req->all());
        unset($request[0]);
        unset($request[1]);

        $master_docs = MasterDokumenModel::whereIn('nama_request', $request)->get();
        $id_pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);
        $path_docs_storage = 'dokumen/' . $user;

        try {
            foreach ($master_docs as $values) {
                $update_docs = FormDokumenModel::updateOrCreate(
                    [
                        'id_pendaftar' => $id_pendaftar->id,
                        'id_m_dokumen' => $values->id,
                    ],
                    [
                        'document_name' => $req->file($values->nama_request)->store($path_docs_storage . '/' . $values->nama_request, 'public')
                    ]
                );
            }

            Toastr::success('Dokumen Telah Ditambahkan', 'Berhasil');
            return redirect('/');
        } catch (\Exception $error) {
            Toastr::error('Terjadi Kesalahan Pada Saat Menyimpan Data, Mohon Isi Data Dengan Benar Dokumen', 'Gagal');
            return back();
        }
    }
}
