<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargesRequest extends FormRequest
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
            'stripeToken' => 'required',
            'ammount' => 'required | numeric',
            'name' => 'required | string | min:5',
            'address1' => 'required | string | min:8',
            'address2' => 'nullable | string | min:6',
            'city' => 'required | string | min:2',
            'state' => 'required | string | min:2',
            'zip' => 'required | numeric | min:5',
            'email' => 'required | email',
            'items' => 'required | array',
            // 'items.Title' => 'required | string',
            // 'items.quant' => 'required | numeric',
            // 'items.Author' => 'required | string',
            // 'items.Cost' => 'required | numeric'
        ];
    }
}
