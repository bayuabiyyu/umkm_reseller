<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use App\Services\Admin\UnitService;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{

    private $productService, $unitService, $categoryService;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(ProductService $productService, UnitService $unitService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->unitService = $unitService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($this->productService->getByID(14));
        return view('admin.master.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['unit'] = $this->unitService->getAll();
        $data['category'] = $this->categoryService->getAll();
        return view('admin.master.product.form_add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $create = $this->productService->create($request);
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
        $data['product'] = $this->productService->getByID($id);
        $data['unit'] = $this->unitService->getAll();
        $data['category'] = $this->categoryService->getAll();
        return view('admin.master.product.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $update = $this->productService->update($id, $request);
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
        $delete = $this->productService->delete($id);
        if($delete){
            $response = [
                'success' => true,
                'message' => "Data berhasil dihapus",
                'code' => 200
            ];
        }
        else{
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
        $datatable = $this->productService->generateDatatable($request);
        return $datatable;
    }

}
