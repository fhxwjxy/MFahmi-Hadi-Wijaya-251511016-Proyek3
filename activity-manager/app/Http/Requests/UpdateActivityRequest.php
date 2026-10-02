<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActivityRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('activities', 'code')->ignore($this->route('activity')),],
            'description' => ['nullable', 'string'],
            'activity_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:Planned,Ongoing,Done'],
        ];
    }
}
