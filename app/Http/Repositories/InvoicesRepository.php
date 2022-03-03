<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\InvoicesInterface;
use App\Http\Traits\DepartmentTrait;
use App\Http\Traits\InvoiceAttachmentTrait;
use App\Http\Traits\InvoicesTrait;
use App\Models\Department;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use tidy;

class InvoicesRepository implements InvoicesInterface
{
    use DepartmentTrait;
    use InvoiceAttachmentTrait;
    use InvoicesTrait;
    private $invoiceModel;
    private $depModel;
    private $invoiceDetailsModel;
    private $invoiceAttachmentModel;
    public function __construct(Invoice $invoice, Department $department, InvoiceDetail $invoiceDetails, InvoiceAttachment $invoiceAttachment)
    {
        $this->invoiceModel = $invoice;
        $this->depModel = $department;
        $this->invoiceDetailsModel = $invoiceDetails;
        $this->invoiceAttachmentModel = $invoiceAttachment;
    }

    public function index()
    {
        $invoices = $this->getAllInvoices();
        return view('invoices.invoices', compact('invoices'));
    }

    public function create()
    {
        $departments = $this->getAllDepartments();
        return view('invoices.create', compact('departments'));
    }

    public function getProduct($id)
    {
        //id which is coming from the page when choosing the department equals to the department id in the products table
        $products = DB::table('products')->where('department_id', $id)->pluck('name', 'id');
        return json_encode($products);

    }

    public function store($request)
    {
        $this->invoiceModel::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'collection_amount' =>$request->collection_amount,
            'commission_value' => $request->commission_value,
            'department_id' => $request->department_id,
            'discount' => $request->discount,
            'tax_rate' => $request->tax_rate,
            'tax_value' => $request->tax_value,
            'total' => $request->total,
            'status' => 'Unpaid', //default status of invoices is unpaid
            'status_value' => 2, //2 referes to unpaid invoices
            'note' => $request->note,
        ]);

        //after adding the invoices we should get the latest id entered in the invoices table
        $invoice_id = $this->invoiceModel::latest()->first()->id;
        //then we start to add fields in the invoices details table
        $this->invoiceDetailsModel::create([
            'invoice_id'=> $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'department' => $request->department_id,
            'status' => 'Unpaid', //default status of invoices is unpaid
            'status_value' => 2, //2 referes to unpaid invoices
            'note' => $request->note,
            'user' => auth()->user()->name
        ]);
        //now we should add file into the invoice attachment table
        if ($request->hasFile('file')) {
            //after adding the invoiceDetails we should get the latest id entered in the invoices table
        $invoice_id = $this->invoiceModel::latest()->first()->id;
        $invoice_number = $request->invoice_number;
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $this->uploadFiles($file, 'Attachments/'. $invoice_number,$fileName);
            $this->invoiceAttachmentModel::create([
                'file_name'=> $fileName,
                'invoice_number' => $request->invoice_number,
                'invoice_id'=>$invoice_id,
                'created_by' => auth()->user()->name

            ]);


        }
        return redirect(route('invoices.index'))->with('success', 'Invoice Has Been Added Successfully');
    }

}
