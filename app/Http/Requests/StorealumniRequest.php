<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorealumniRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'no_absen' => 'required|numeric',
            'no_reg' => 'required|numeric|unique:alumni,no_reg', // Validasi unik ditambahkan
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'photo' => 'required|image|max:4024',
            'pelaksaan_diklat_id' => 'nullable|exists:App\Models\PelaksaanDiklat,id',
        ];
    }
}
