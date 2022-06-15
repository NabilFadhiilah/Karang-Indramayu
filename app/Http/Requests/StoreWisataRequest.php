<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreWisataRequest extends FormRequest
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
            'nama_wisata' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
            'tgl_reservasi_awal' => 'required',
            'tgl_reservasi_akhir' => 'required',
            'durasi_wisata' => 'required',
            'harga' => 'required',
            'ketentuan' => 'required',
        ];
    }
}
