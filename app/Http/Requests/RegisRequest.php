<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisRequest extends FormRequest
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
        return 
        [
            'fullname'=>['required'],
            'username'=>['required', 'unique:users,username'],
            'email'=>['required',  'unique:users,email', 'email:dns'],
            'password'=>['required', 'min:6']

        ];
    }

    // public function messages()
    // {
    //     return 
    //     [
    //         'required' => 'Form ini Wajib Diisi'
    //     ];
    // }
}
