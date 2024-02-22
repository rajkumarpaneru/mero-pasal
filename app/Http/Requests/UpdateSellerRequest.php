<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:191'],
            'address' => ['required', 'string', 'min:2', 'max:191'],
            'registration_type' => ['required', 'string', 'max:191'],
            'registration_number' => ['required', 'string', 'max:191'],
        ];
    }
}
