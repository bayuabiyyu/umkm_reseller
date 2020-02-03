<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Unit;
use Yajra\DataTables\Facades\DataTables;

class UnitService
{

    private $unit;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }

    /**
     * Get all data json
     *
     * @return collection
     */
    public function getAll()
    {
        return $this->unit->get();
    }

    /**
     * Get by ID
     *
     * @return resource
     */
    public function getByID($id)
    {
        return $this->unit->where('id', $id)
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
            'unit_code' => $request->input('unit_code'),
            'unit_name' => $request->input('unit_name'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->unit->create($data);
        return $create;
    }

    /**
     * Delete data
     *
     * @return bool
     */
    public function delete($id)
    {
        $delete = $this->unit->where('id', $id)
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
            'unit_name' => $request->input('unit_name')
        ];
        $update = $this->unit->where('id', $id)
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
                        $btnEdit = '<a href="'.route('admin.unit.edit', $data->id).'" id="btn_edit" class="btn btn-sm btn-primary" title="Edit"> <i class="fas fa-edit"> </i> Edit</a>';
                        $btnDelete = '<a href="'.route('admin.unit.destroy', $data->id).'" id="btn_delete" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"> </i> Delete</a>';
                        return $btnEdit. " &nbsp; " .$btnDelete;
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->make(true);
        return $generate;
    }


}
