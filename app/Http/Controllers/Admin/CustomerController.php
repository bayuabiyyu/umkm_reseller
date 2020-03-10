<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\CustomerService;
use App\Http\Requests\Admin\CustomerRequest;

class CustomerController extends Controller
{

    private $customerService;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.customer.form_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $create = $this->customerService->create($request);
        if($create){
            $response = [
                'success' => true,
                'message' => "Data berhasil ditambahkan",
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
        $data = $this->customerService->getByID($id);
        return view('admin.master.customer.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $update = $this->customerService->update($id, $request);
        if($update){
            $response = [
                'success' => true,
                'message' => "Data berhasil diubah",
                'code' => 200
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error Execution",
                'errors' => ["Data gagal diubah"],
                'code' => 422
            ];
        }
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->customerService->delete($id);
        if($delete){
            $response = [
                'success' => true,
                'message' => "Data berhasil dihapus",
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

    /**
     * Datatables yajra function
     *
     * @param \Illuminate\Http\Request  $request
     * @return datatables
     */
    public function dataTable(Request $request)
    {
        $datatable = $this->customerService->generateDatatable($request);
        return $datatable;
    }

    /**
     * Get all customer
     *
     * @return json
     */
    public function getByID(Request $request)
    {
        $id = $request->input('customer_id');
        $data = $this->customerService->getByID($id);
        if( !is_null($data) ){
            $response = [
                'success' => true,
                'message' => "Data berhasil terima",
                'data' => $data,
                'code' => 200
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error Execution",
                'errors' => ["Data gagal diterima"],
                'code' => 422
            ];
        }
        return response()->json($response, $response['code']);
    }

}
