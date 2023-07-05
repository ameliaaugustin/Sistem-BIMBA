<?php

namespace App\Http\Requests\pendaftar\form_pendaftaran;

use Illuminate\Foundation\Http\FormRequest;

class FormIbuRequest extends FormRequest
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
            'nama_ibu' => ['required'],
            'tempat_lahir_ibu' => ['required'],
            'tgl_lahir_ibu' => ['required'],
            'pendidikan_ibu' => ['required'],
            'pekerjaan_ibu' => ['required'],
            'alamat_ibu' => ['required'],
            'no_telp_ibu' => ['required']
        ];
    }
}
