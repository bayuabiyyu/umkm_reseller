<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;

class CustomerService
{

    private $customer;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get all data json
     *
     * @return collection
     */
    public function getAll()
    {
        return $this->customer->get();
    }

    /**
     * Get by ID
     *
     * @return resource
     */
    public function getByID($id)
    {
        return $this->customer->where('id', $id)
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
            'customer_code' => $request->input('customer_code'),
            'customer_name' => $request->input('customer_name'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->customer->create($data);
        return $create;
    }

    /**
     * Delete data
     *
     * @return bool
     */
    public function delete($id)
    {
        $delete = $this->customer->where('id', $id)
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
            'customer_name' => $request->input('customer_name')
        ];
        $update = $this->customer->where('id', $id)
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
                        $btnEdit = '<a href="'.route('admin.customer.edit', $data->id).'" id="btn_edit" class="btn btn-sm btn-primary" title="Edit"> <i class="fas fa-edit"> </i> Edit</a>';
                        $btnDelete = '<a href="'.route('admin.customer.destroy', $data->id).'" id="btn_delete" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"> </i> Delete</a>';
                        return $btnEdit. " &nbsp; " .$btnDelete;
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->make(true);
        return $generate;
    }


}
