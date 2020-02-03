<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{

    private $categoryService;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.category.form_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $create = $this->categoryService->create($request);
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
        $data = $this->categoryService->getByID($id);
        return view('admin.master.category.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $update = $this->categoryService->update($id, $request);
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
        $delete = $this->categoryService->delete($id);
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
        $datatable = $this->categoryService->generateDatatable($request);
        return $datatable;
    }

}
