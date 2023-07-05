<?php

namespace App\Http\Requests\pendaftar\form_pendaftaran;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\admin\master_data\MasterDokumenModel;

class FormDokumenRequest extends FormRequest
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
        $documents = MasterDokumenModel::get();

        $req_keys = array_keys(Request::all());
        unset($req_keys[0]);
        unset($req_keys[1]);

        $check_storage = Storage::exists('dokumen/' . auth()->user()->id);

        if ($check_storage != true) {
            $arr_validate = [];
            foreach ($documents as $value) {
                $arr_validate[$value->nama_request] = json_decode($value->validasi);
            }

            return $arr_validate;
        } else {
            $pendaftar = DB::table('dt_pendaftar')->where('user_id', auth()->user()->id)->first();

            $arr_validate_update = [];
            foreach ($req_keys as $keys) {
                $documents = MasterDokumenModel::firstWhere('nama_request', $keys);

                $arr_validate_update[$documents->nama_request] = json_decode($documents->validasi);
            }

            $dt_dokumen = DB::table('dt_dokumen')->where('id_pendaftar', $pendaftar->id)->get();
            foreach ($dt_dokumen as $value) {
                Storage::delete($value->document_name);
            }


            return $arr_validate_update;
        }
    }
}
