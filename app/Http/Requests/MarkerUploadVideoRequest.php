<?php

namespace App\Http\Requests;


class MarkerUploadVideoRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'marker_id' => 'required|integer',
            'marker_item_id' => 'sometimes|integer',
            'video' => 'required|mimetypes:video/mp4|max:500000'
        ];
    }
}
