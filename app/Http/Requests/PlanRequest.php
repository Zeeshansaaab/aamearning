<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->input('id')){
            return  [
                'name'   => ['required', Rule::unique('plans')->ignore(request()->input('id'))],
                'price' => 'required',
            ];
        }

        return  [
            'name' => 'required| unique:plans',
            'price' => 'required',
        ];
    }
}
