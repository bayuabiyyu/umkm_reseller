<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Services\Admin\SaleService;

class StoreTmpSaleDetailRequest extends FormRequest
{

    private $saleService;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

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
        $adminID = auth('admin')->user()->id;
        $tmpSale = $this->saleService->getTmpSaleByAdmin($adminID);
        // Rules null null untuk validasi two columns ... formatnya unique:tableName,column1,NULL,NULL,column2,ID Dari Column 2 yang sudah di get
        $rules = [
            'id_product' => 'required|unique:tmp_sale_detail,product_id,NULL,NULL,tmp_sale_id,'.$tmpSale->id,
            'price_product' => 'required',
            'qty_product' => 'required',
            'sub_total_product' => 'required',
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
            'product.unique' => 'Product sudah ada, silahkan pilih yang lain',
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
            'id_product' => 'Product ID',
            'price_product' => 'Product Price',
            'qty_product' => 'Product Qty',
            'sub_total_product' => 'Product Sub. Total',
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
            'message' => "Error Validation",
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }

}
