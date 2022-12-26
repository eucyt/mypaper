<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaperRequest extends FormRequest
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
            "title" => ["required", "max:255"],
            "memo" => [],
            "url" => [],
            "pdf" => [],
            "author" => [],
            "journal" => [],
            "publisher" => [],
            "volume" => ["nullable", "numeric"],
            "number" => ["nullable", "numeric"],
            "pages" => [],
            "year" => ["nullable", "numeric"],
        ];
    }
}
