<?php

namespace App\Http\Requests;

use App\Http\Responses\BaseResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function expectsJson()
    {
        return false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','max:255', 'email', 'unique:users'],
            'no_telp' => ['required', 'string', 'max:15'],
            'nama_bank' => ['required', 'string', 'max:255'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'no_rekening' => ['required', 'string', 'max:255'],
            'ktp_image' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'ktp_image' => ['required', 'image', 'max:2048', 'mimes:jpg,png,jpeg,svg'],
            'password' => ['required','string','min:8']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Kirim respons JSON khusus untuk error validasi
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => null,
                'errors' => $validator->errors(),
            ], 422)
        );
    }

}
