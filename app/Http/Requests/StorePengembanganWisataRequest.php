<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePengembanganWisataRequest extends FormRequest
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
            'id_wisata' => 'required',
            'target_dana' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'imbal_hasil' => 'required|max:255',
            'min_investasi' => 'required|max:255',
        ];
    }
}
