<?php

namespace App\Http\Requests\Film;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'string',
            'description' => 'string',
            'release_date' => 'date',
            'rating' => 'in:1,2,3,4,5',
            'genres' => 'exists:genres,id',
            'ticket_price' => 'numeric|min:0',
            'country' => 'string',
            'photo' => 'file|mimes:jpeg,bmp,png|min:0|max:1024'
        ];
    }
}
