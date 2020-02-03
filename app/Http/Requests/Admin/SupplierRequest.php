<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierRequest extends FormRequest
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
        $rules = $this->method();
        if($rules == "POST"){
            return $this->createRules();
        }elseif($rules == "PUT" || $rules == "PATCH"){
            return $this->updateRules();
        }

    }

    /**
     * Create rules
     *
     * @return rules
     */
    public function createRules()
    {
        $rules = [
            'supplier_code' => 'required|max:20|unique:supplier,supplier_code',
            'supplier_name' => 'required|max:50',
            'phone_number' => 'required|max:20',
            'address' => 'required|max:100',
            'city' => 'required|max:20',
            'owner' => 'required|max:50',
        ];
        return $rules;
    }

    /**
     * Updated rules
     *
     * @return rules
     */
    public function updateRules()
    {
        $rules = [
            'supplier_code' => 'required|max:20|unique:supplier,supplier_code,'.$this->route('id'),
            'supplier_name' => 'required|max:50',
            'phone_number' => 'required|max:20',
            'address' => 'required|max:100',
            'city' => 'required|max:20',
            'owner' => 'required|max:50',
        ];
        return $rules;
    }

    /**
     * Message for validation
     *
     * @return messages
     */
    public function messages()
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada',
            'max' => ':attribute melebihi panjang maksimal',
        ];
        return $messages;
    }

    /**
     * Attributes field
     *
     * @return attrributes
     */
    public function attributes()
    {
        $attributes = [
            'supplier_code' => 'Supplier Code',
            'supplier_name' => 'Supplier Name',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'city' => 'City',
            'owner' => 'Owner',
        ];
        return $attributes;
    }

    /**
     * Validation failed
     *
     * @return json
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'error-code' => 422,
            'errors' => $validator->errors()->all(),
            'message' => "Error Validation ".$this->route('id'),
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }

}
