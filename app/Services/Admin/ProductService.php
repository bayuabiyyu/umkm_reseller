<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ProductService
{

    private $product;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get all data json
     *
     * @return collection
     */
    public function getAll()
    {

        // $data = DB::table('product AS p')
        //         ->leftJoin('unit AS u', 'p.unit_id', '=', 'u.id')
        //         ->leftJoin('category AS c', 'p.category_id', '=', 'c.id')
        //         ->get( DB::raw('p.*, u.id AS unit_id, u.unit_name, c.id AS category_id, c.category_name') );
        // return $data;

        return $this->product
                ->leftJoin('unit', 'product.unit_id', '=', 'unit.id')
                ->leftJoin('category', 'product.category_id', '=', 'category.id')
                ->get(['product.*', 'unit_name', 'category_name', 'unit.id AS unit_id', 'category.id AS category_id']);

    }

    /**
     * Get by ID
     *
     * @return resource
     */
    public function getByID($id)
    {
        return $this->product
                ->leftJoin('unit', 'product.unit_id', '=', 'unit.id')
                ->leftJoin('category', 'product.category_id', '=', 'category.id')
                ->where('product.id', $id)
                ->first(['product.*', 'unit_name', 'category_name', 'unit.id AS unit_id', 'category.id AS category_id']);
    }

    /**
     * Save data
     *
     * @return bool
     */
    public function create($request)
    {
        DB::beginTransaction();
        try{
            // Image Handling
            $file = $request->file('image');
            // upload ke folder storage/app + encrypt filename
            $path = $file->store('public/product_image');
            $data = [
                'unit_id' => $request->input('unit_id'),
                'category_id' => $request->input('category_id'),
                'product_code' => $request->input('product_code'),
                'product_name' => $request->input('product_name'),
                'stock' => $request->input('stock'),
                'stock_min' => $request->input('stock_min'),
                'price_purchase' => $request->input('price_purchase'),
                'price_sale' => $request->input('price_sale'),
                'price_reseller' => $request->input('price_reseller'),
                'image' =>  $path,
                'created_by' => auth('admin')->user()->id,
                'updated_by' => auth('admin')->user()->id,
            ];
            $this->product->create($data);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollback();
            return false;
        }

    }

    /**
     * Delete data
     *
     * @return bool
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try{
            // Get Proeduct Data Before Delete Data
            $product = $this->getByID($id);
            // Delete Data
            $delete = $this->product->where('id', $id)
                        ->delete();
            // If Delete Success
            if($delete){
                // If File Exists
                if(Storage::exists($product->image)){
                    // File Delete
                    Storage::delete($product->image);
                }
                DB::commit();
                return true;
            }
        }catch(\Exception $e){
            DB::rollback();
            return false;
        }
    }

    /**
     * Update data
     *
     * @return bool
     */
    public function update($id, $request)
    {
        DB::beginTransaction();
        try{
            // Get Product Data Before Update
            $product = $this->getByID($id);
            // Image Handling, If Upload
            if($request->has('image') && Storage::exists($product->image)){
                // If Product Image Success Delete, Fill Variabel Path Image from Request File
                if(Storage::delete($product->image)){
                    $image = $request->file('image');
                    $path_image = $image->store('public/product_image');
                }
            }else{
                // If Not Upload, Fill Variabel Path Image From Product Image DB
                $path_image = $product->image;
            }
            $data = [
                'unit_id' => $request->input('unit_id'),
                'category_id' => $request->input('category_id'),
                'product_name' => $request->input('product_name'),
                'stock' => $request->input('stock'),
                'stock_min' => $request->input('stock_min'),
                'price_purchase' => $request->input('price_purchase'),
                'price_sale' => $request->input('price_sale'),
                'price_reseller' => $request->input('price_reseller'),
                'image' => $path_image,
                'created_by' => auth('admin')->user()->id,
                'updated_by' => auth('admin')->user()->id,
            ];
            $this->product->where('id', $id)->update($data);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollback();
            return false;
        }

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
                        $btnEdit = '<a href="'.route('admin.product.edit', $data->id).'" id="btn_edit" class="btn btn-sm btn-primary" title="Edit"> <i class="fas fa-edit"> </i> Edit</a>';
                        $btnDelete = '<a href="'.route('admin.product.destroy', $data->id).'" id="btn_delete" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"> </i> Delete</a>';
                        return $btnEdit. " &nbsp; " .$btnDelete;
                    })
                    ->editColumn('image', function($data){
                        $path = Storage::url($data->image);
                        return Storage::exists($data->image) ? '<a target="_blank" href="'. $path .'"> <img src="'. $path .'" height="42" width="42"> </a>' : '<span class="badge badge-info"> Not Found </span>';
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->rawColumns(['image', 'action'])
                    ->make(true);
        return $generate;
    }

        /**
     * Datatables service yajra
     *
     * @return datatables
     */
    public function generateDatatableForSale($request)
    {
        $data = $this->getAll();
        $generate = Datatables::of($data)
                    ->addColumn('action', function($data){
                        $btnPilih = '<a href="#" id="btn_pilih" class="btn_pilih btn btn-sm btn-primary" title="Choose"> <i class="fas fa-check"> </i> Choose</a>';
                        return $btnPilih;
                    })
                    ->editColumn('image', function($data){
                        $path = Storage::url($data->image);
                        return Storage::exists($data->image) ? '<a target="_blank" href="'. $path .'"> <img src="'. $path .'" height="42" width="42"> </a>' : '<span class="badge badge-info"> Not Found </span>';
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->rawColumns(['image', 'action'])
                    ->make(true);
        return $generate;
    }


}
