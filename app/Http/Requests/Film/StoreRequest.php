<?php

namespace App\Http\Requests\Film;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'string|required',
            'description' => 'string|required',
            'release_date' => 'date|required',
            'rating' => 'required|in:1,2,3,4,5',
            'genres' => 'array|exists:genres,id|required',
            'ticket_price' => 'required|numeric|min:0',
            'country' => 'string|required',
            'photo' => 'required|file|mimes:jpeg,bmp,png|min:0|max:1024'
        ];
    }
}
