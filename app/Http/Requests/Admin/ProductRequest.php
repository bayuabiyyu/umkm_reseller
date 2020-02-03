<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'unit_id' => 'required|max:20',
            'category_id' => 'required|max:20',
            'product_code' => 'required|max:10|unique:product,product_code',
            'product_name' => 'required|max:20',
            'stock' => 'required|integer',
            'stock_min' => 'required|integer',
            'price_purchase' => 'required|integer',
            'price_sale' => 'required|integer',
            'price_reseller' => 'required|integer',
            'image' => 'required|mimes:jpeg,jpg,png|max:512', // Max 512KB
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
            'unit_id' => 'required|max:20',
            'category_id' => 'required|max:20',
            'product_code' => 'required|max:10|unique:product,product_code,'.$this->route('id'),
            'product_name' => 'required|max:20',
            'product_name' => 'required|max:20',
            'stock' => 'required|integer',
            'stock_min' => 'required|integer',
            'price_purchase' => 'required|integer',
            'price_sale' => 'required|integer',
            'price_reseller' => 'required|integer',
            'image' => 'mimes:jpeg,jpg,png|max:512', // Max 512KB
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
            'max.image' => 'Ukuran file :attributes melebihi panjang maksimal'
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
            'unit_id' => 'Unit',
            'category_id' => 'Category',
            'product_code' => 'Product Code',
            'product_name' => 'Product Name',
            'stock' => 'Stock',
            'stock_min' => 'Stock Min',
            'price_purchase' => 'Price Purchase',
            'price_sale' => 'Price Sale',
            'price_reseller' => 'Price Reseller',
            'image' => 'Image',
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
