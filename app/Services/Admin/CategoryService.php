<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{

    private $category;

    /**
     * Init class
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get all data json
     *
     * @return collection
     */
    public function getAll()
    {
        return $this->category->get();
    }

    /**
     * Get by ID
     *
     * @return resource
     */
    public function getByID($id)
    {
        return $this->category->where('id', $id)
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
            'category_code' => $request->input('category_code'),
            'category_name' => $request->input('category_name'),
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
        ];
        $create = $this->category->create($data);
        return $create;
    }

    /**
     * Delete data
     *
     * @return bool
     */
    public function delete($id)
    {
        $delete = $this->category->where('id', $id)
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
            'category_name' => $request->input('category_name')
        ];
        $update = $this->category->where('id', $id)
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
                        $btnEdit = '<a href="'.route('admin.category.edit', $data->id).'" id="btn_edit" class="btn btn-sm btn-primary" title="Edit"> <i class="fas fa-edit"> </i> Edit</a>';
                        $btnDelete = '<a href="'.route('admin.category.destroy', $data->id).'" id="btn_delete" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"> </i> Delete</a>';
                        return $btnEdit. " &nbsp; " .$btnDelete;
                    })
                    ->addIndexColumn()
                    ->removeColumn(['created_at', 'updated_at', 'created_by', 'updated_by'])
                    ->make(true);
        return $generate;
    }


}
