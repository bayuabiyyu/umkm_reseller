<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Yajra\DataTables\Facades\DataTables;

class SupplierService
{

    private $supplier;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * Get all data json
     *
     * @return collection
     */
    public function getAll()
    {
        return $this->supplier->get();
    }

    /**
     * Get by ID
     *
     * @return resource
     */
    public function getByID($id)
    {
        return $this->supplier->where('id', $id)
            ->first();
    }

    /**
     * Save data
     *
     * @return bool
     */
    public function create(Request $request)
    {
        $data = [
            'supplier_code' => $request->input('supplier_code'),
            'supplier_name' => $request->input('supplier_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'owner' => $request->input('owner'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->supplier->create($data);
        return $create;
    }

    /**
     * Delete data
     *
     * @return bool
     */
    public function delete($id)
    {
        $delete = $this->supplier->where('id', $id)
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
            'supplier_name' => $request->input('supplier_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'owner' => $request->input('owner'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $update = $this->supplier->where('id', $id)
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
                        $btnEdit = '<a href="'.route('admin.supplier.edit', $data->id).'" id="btn_edit" class="btn btn-sm btn-primary" title="Edit"> <i class="fas fa-edit"> </i> Edit</a>';
                        $btnDelete = '<a href="'.route('admin.supplier.destroy', $data->id).'" id="btn_delete" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"> </i> Delete</a>';
                        return $btnEdit. " &nbsp; " .$btnDelete;
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->make(true);
        return $generate;
    }


}
