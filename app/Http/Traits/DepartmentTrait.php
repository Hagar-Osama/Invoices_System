<?php
namespace App\Http\Traits;

trait DepartmentTrait {
    private function getAllDepartments()
    {
        return $this->depModel::get();
    }

    private function getDepartmentById($depId)
    {
        return $this->depModel::find($depId);
    }

}
