<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'   => 'required',
            'nama_service'  => 'required',
            'img'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'desc'          => 'required',
            'price'         => 'required',
            'publish_date'  => 'required',
        ];
    }
}
