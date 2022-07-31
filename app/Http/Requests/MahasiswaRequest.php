<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MahasiswaRequest extends FormRequest
{ 
    public function authorize()
    {
        return true;
    }
 
    public function rules()
    {
        return [
            'nama' => 'required|min:5|max:255',
            'stambuk' => 'required|max:255',
            'prodi' => 'required|max:255',
            'fakultas' => 'required|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'response' => array(
                'icon' => 'error',
                'title' => 'Validasi Gagal',
                'message' => 'Data yang di input tidak tervalidasi',
            ),
            'errors' => array(
                'length' => count($validator->errors()),
                'data' => $validator->errors()
            ),
        ], 422));
    }
}
