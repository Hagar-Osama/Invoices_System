<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\DepartmentInterface;
use App\Http\Traits\DepartmentTrait;
use App\Models\Department;

class DepartmentRepository implements DepartmentInterface
{
    use DepartmentTrait;
    private $depModel;

    public function __construct(Department $department)
    {
        $this->depModel = $department;

    }

    public function index()
    {
        $departments = $this->getAllDepartments();
        return view('departments.departments', compact('departments'));
    }

    public function store($request)
    {
        $data = $this->depModel::where('name', $request->name)->exists();
        if($data) {
            session()->flash('error', 'Department already exists');
        return redirect(route('departments.index'));
        }else{
            $this->depModel::create([
                'name' => $request->name,
                'description' => $request->description,
                'created_by' => auth()->user()->name
            ]);
            session()->flash('success', 'Department has been added successfully');
            return redirect(route('departments.index'));
        }
    }

    public function update($request)
    {
        $department = $this->getDepartmentById($request->dep_id);
        $department->update([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->user()->name

        ]);
        session()->flash('success', 'Department has been Updated successfully');
        return redirect(route('departments.index'));

    }

    public function delete($request)
    {
        $department = $this->getDepartmentById($request->dep_id);
        $department->delete();
        session()->flash('success', 'Department has been Deleted successfully');
        return redirect(route('departments.index'));

    }
}
