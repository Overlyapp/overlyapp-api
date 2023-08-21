<?php

namespace App\Http\Requests;


class UpdateMarkerRequest extends AppRequest
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
            'name' => 'required|string',
            'project_id' => 'required|integer',
            'marker_id' => 'required|integer',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:20480'
        ];
    }
}
