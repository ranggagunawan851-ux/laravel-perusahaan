<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PortofolioRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         'title'        => 'required|min:3',
    //         'category_id'  => 'required|integer',
    //         'desc'         => 'required',
    //         'client'       => 'required',
    //         'img'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    //         'status'       => 'required',
    //         'publish_date' => 'nullable|date',
    //     ];
    // }

    public function rules(): array
{
    return [
        'title'       => 'required|string|max:255',
        'desc'        => 'required',
        'category_id' => 'required|exists:categories,id',
        'client'      => 'nullable|string',
        'status'      => 'required',
        'publish_date'=> 'nullable|date',

        // Ubah validasi img menjadi array dan validasi setiap item di dalamnya (img.*)
        'img'         => 'nullable|array',
        'img.*'       => 'image|mimes:jpeg,png,jpg,webp|max:2048',
    ];
}
}
