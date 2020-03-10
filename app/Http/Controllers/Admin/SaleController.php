<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTmpSaleDetailRequest;
use Illuminate\Http\Request;
use App\Services\Admin\SaleService;
use App\Services\Admin\CustomerService;

class SaleController extends Controller
{

    private $saleService, $customerService;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(SaleService $saleService, CustomerService $customerService)
    {
        $this->saleService = $saleService;
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminID = auth('admin')->user()->id;
        $data['sale'] = $this->saleService->getTmpSaleByAdmin($adminID);
        return $data['sale']->tmp_details[0]->product->product_name;

        // return "Development di menu create";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init create
        $adminID = auth('admin')->user()->id;
        $data['sale'] = $this->saleService->getTmpSaleByAdmin($adminID);
        $data['customer'] = $this->customerService->getAll();

        // Jika null maka insert tmpsale
        if( is_null($data['sale']) ){
            $this->saleService->createTmpSale();
        }

        return view('admin.transaction.sale.form_add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // ---------- TEMPORARY TABLE MODULE ---------- //

    /**
     * Get all tmp detail sale
     *
     * @return collection
     */
    public function getTableTmpDetail()
    {
        $adminID = auth('admin')->user()->id;
        $data = $this->saleService->getTmpSaleByAdmin($adminID);
        return view('admin.transaction.sale.table_detail_product', compact('data'));
    }

    /**
     * Store to tmp detail sale
     *
     * @param request
     * @return json
     */
    public function storeTmpDetail(StoreTmpSaleDetailRequest $request)
    {
        $adminID = auth('admin')->user()->id;
        $create = $this->saleService->createTmpDetail($request);

        // Get data sale for sub total sum
        $data['sale'] = $this->saleService->getTmpSaleByAdmin($adminID);

        if($create){
            $response = [
                'success' => true,
                'message' => "Data berhasil ditambahkan",
                'data' => ['sub_total_sum' => !is_null($data['sale']) ? number_format( $data['sale']->tmp_details->sum('sub_total') ) : 0 ],
                'code' => 200
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error Execution",
                'errors' => ["Data gagal ditambahkan"],
                'code' => 422
            ];
        }
        return response()->json($response, $response['code']);
    }

    /**
     * Delete TMP Detail
     *
     * @return json
     */
    public function destroyTmpDetail($id)
    {
        $delete = $this->saleService->deleteTmpDetail($id);
        $adminID = auth('admin')->user()->id;
        // Get data sale for sub total sum
        $data['sale'] = $this->saleService->getTmpSaleByAdmin($adminID);

        if($delete){
            $response = [
                'success' => true,
                'message' => "Data berhasil dihapus",
                'data' => ['sub_total_sum' => !is_null($data['sale']) ? number_format( $data['sale']->tmp_details->sum('sub_total') ) : 0 ],
                'code' => 200
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error Execution",
                'errors' => ["Data gagal dihapus"],
                'code' => 422
            ];
        }
        return response()->json($response, $response['code']);
    }

}
