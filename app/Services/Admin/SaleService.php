<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Sale;
use App\Models\Sale_Detail;
use App\Models\Tmp_Sale;
use App\Models\Tmp_Sale_Detail;

class SaleService
{

    private $sale, $saleDetail, $tmpSale, $tmpSaleDetail;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(Sale $sale, Sale_Detail $saleDetail, Tmp_Sale $tmpSale, Tmp_Sale_Detail $tmpSaleDetail)
    {
        $this->sale = $sale;
        $this->saleDetail = $saleDetail;
        $this->tmpSale = $tmpSale;
        $this->tmpSaleDetail = $tmpSaleDetail;
    }

    /**
     * Get all data json
     *
     * @return collection
     */
    public function getAll()
    {
        return $this->sale->get();
    }

    /**
     * Get by ID
     *
     * @return resource
     */
    public function getByID($id)
    {
        return $this->sale->where('id', $id)
            ->first();
    }


    /**
     * Save data
     *
     * @return bool
     */
    public function create($request)
    {
        $data = [
            'sale_code' => $request->input('sale_code'),
            'sale_name' => $request->input('sale_name'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->sale->create($data);
        return $create;
    }

    /**
     * Delete data
     *
     * @return bool
     */
    public function delete($id)
    {
        $delete = $this->sale->where('id', $id)
                    ->delete();
        return $delete;
    }

    /**
     * Update data
     *
     * @return bool
     */
    public function update($id, $request)
    {
        $data = [
            'sale_name' => $request->input('sale_name')
        ];
        $update = $this->sale->where('id', $id)
                    ->update($data);
        return $update;
    }

    /**
     * Datatables service yajra
     *
     * @return datatables
     */
    public function generateDatatable($request)
    {
        $data = $this->getAll();
        $generate = Datatables::of($data)
                    ->addColumn('action', function($data){
                        $btnEdit = '<a href="'.route('admin.sale.edit', $data->id).'" id="btn_edit" class="btn btn-sm btn-primary" title="Edit"> <i class="fas fa-edit"> </i> Edit</a>';
                        $btnDelete = '<a href="'.route('admin.sale.destroy', $data->id).'" id="btn_delete" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"> </i> Delete</a>';
                        return $btnEdit. " &nbsp; " .$btnDelete;
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->make(true);
        return $generate;
    }

    /**
     * Generate Sale Code
     *
     * @return string
     */
    public function saleCode()
    {
        // Example : TRX/SALE/2020/2/1
    }

    // ---------- TMP TABLE ---------- //

    /**
     * Get TMPSale
     *
     * @return collection
     */
    public function getTmpSaleByAdmin($id)
    {
        $adminID = $id;
        $temporarySale = $this->tmpSale
                        ->with('tmp_details.product')
                        ->where('admin_id', $adminID)
                        ->first();
        return $temporarySale;
    }

    /**
     * Create TMP Sale for Init
     *
     * @return bool
     */
    public function createTmpSale()
    {
        $adminID = auth('admin')->user()->id;
        $data = [
            'admin_id' => $adminID,
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->tmpSale->create($data);
        return $create;

    }

    /**
     * Create TMP Detail
     *
     * @return bool
     */
    public function createTmpDetail($request)
    {
        // Get Tmp sale
        $adminID = auth('admin')->user()->id;
        $dataTmpSale = $this->getTmpSaleByAdmin($adminID);

        $data = [
            'tmp_sale_id' => $dataTmpSale->id,
            'product_id' => $request->input('id_product'),
            'price' => $request->input('price_product'),
            'qty' => $request->input('qty_product'),
            'sub_total' => $request->input('qty_product') * $request->input('price_product'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->tmpSaleDetail->create($data);
        return $create;

    }

    /**
     * Delete TMP Detail
     *
     * @return bool
     */
    public function deleteTmpDetail($id)
    {
        $delete = $this->tmpSaleDetail->where('id', $id)
                    ->delete();
        return $delete;

    }

}
