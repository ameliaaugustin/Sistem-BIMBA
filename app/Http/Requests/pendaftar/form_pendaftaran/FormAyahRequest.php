<?php

namespace App\Http\Requests\pendaftar\form_pendaftaran;

use Illuminate\Foundation\Http\FormRequest;

class FormAyahRequest extends FormRequest
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
            'nama_ayah' => ['required'],
            'tempat_lahir_ayah' => ['required'],
            'tgl_lahir_ayah' => ['required'],
            'pendidikan_ayah' => ['required'],
            'pekerjaan_ayah' => ['required'],
            'alamat_ayah' => ['required'],
            'no_telp_ayah' => ['required']
        ];
    }
}
