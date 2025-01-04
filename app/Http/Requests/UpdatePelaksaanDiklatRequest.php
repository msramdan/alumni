<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelaksaanDiklatRequest extends FormRequest
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
            'diklat_id' => 'nullable|exists:App\Models\Diklat,id',
            'judul_diklat' => 'required|string|max:255',
            'angkatan' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ];
    }
}
