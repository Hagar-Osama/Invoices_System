<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CustomersReportsInterface;
use App\Http\Traits\DepartmentTrait;
use App\Models\Department;
use App\Models\Invoice;

class CustomersReportsRepository implements CustomersReportsInterface
{
    use DepartmentTrait;
    private $invoicesModel;
    private $depModel;
    public function __construct(Invoice $invoices, Department $department)
    {
        $this->invoicesModel = $invoices;
        $this->depModel = $department;
    }
    public function index()
    {
        $departments = $this->getAllDepartments();
        return view('reports.customersReports', compact('departments'));
    }

    public function search($request)
    {
        //in case no date selected
        if ($request->department_id && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = $this->invoicesModel::select('*')->where([['department_id', $request->department_id], ['product', $request->product]])->get();
            $departments = $this->getAllDepartments();
            return view('reports.customersReports', compact('invoices', 'departments'));
        } else {
            //in case date selected
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = $this->invoicesModel::whereBetween('invoice_date', [$start_at, $end_at])->where('department_id', $request->department_id)->get();
            $departments = $this->getAllDepartments();
            return view('reports.customersReports', compact('invoices', 'departments'));
        }
    }
}
