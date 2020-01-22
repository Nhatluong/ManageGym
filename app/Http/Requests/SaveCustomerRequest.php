<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCustomerRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required'| 'unique:customers,email,' . $this->id],
            'number_phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'address' => 'required',
            'date_buy' => 'required',
            'date_end' => 'required',
        ];
    }
}
