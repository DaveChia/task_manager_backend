<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string','max:255', 'min:10'],
            'description' => ['nullable','string', 'min:10'],
            'completed_at' => ['nullable','date'],
        ];
    }
}