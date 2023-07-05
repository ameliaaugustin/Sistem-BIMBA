<?php

namespace App\Http\Requests\pendaftar\form_pendaftaran;

use Illuminate\Foundation\Http\FormRequest;

class FormPendaftarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_lengkap' => ['required'],
            'nama_panggilan' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            //    'asal_sekolah' => ['required'],
            'anak_ke' => ['required'],
            // 'hobi' => ['required'],
            'agama' => ['required'],
            'riwayat_sakit' => ['required'],
            'konsumsi_obat' => ['required'],
            'pernah_les' => ['required'],
            // 'old_nama_lembaga' => ['required'],
            // 'old_level_les' => ['required'],
            'sosmed_options' => ['required'],
            'alasan_memilih' => ['required'],



        ];
    }
}
