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
            'no_reg' => 'required|numeric',
			'nama' => 'required|string|max:255',
			'tempat_lahir' => 'required|string|max:255',
			'tanggal_lahir' => 'required|date',
        ];
    }
}
