<?php

namespace App\Http\Requests;

use App\Rules\FileTypeValidate;
use Illuminate\Foundation\Http\FormRequest;

class ManualGatewayRequest extends FormRequest
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
        return [
                'name'              => ['required', 'max: 60', 'unique:gateways,name,' . request()->input('id')],
                'image'             => [request()->input('id') ? 'nullable' : 'required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
                'rate'              => 'required|gt:0',
                'currency'          => 'required',
                'min_limit'         => 'required|gt:0',
                'max_limit'         => 'required|gte:0',
                'fixed_charge'      => 'required|gte:0',
                'percentage_charge' => 'required|between:0,100',
                'instruction'       => 'required|max:64000',
        ];
    }
}
