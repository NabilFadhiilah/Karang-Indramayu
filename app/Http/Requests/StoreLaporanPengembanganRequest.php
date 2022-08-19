<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLaporanPengembanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'pengeluaran' => 'required',
            'biaya_pengeluaran' => 'required',
            'tgl_pengeluaran' => 'required',
            'ket_pengeluaran' => 'required'
        ];
    }
}
