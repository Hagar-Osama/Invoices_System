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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function getProduct($depId)
    {
        //id which is coming from the page when choosing the department equals to the department id in the products table
        $products = DB::table('products')->where('department_id', $depId)->pluck('name', 'id');
        return json_encode($products);
    }

    public function store($request)
    {
        $this->invoiceModel::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'collection_amount' => $request->collection_amount,
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
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'department' => $request->department_id,
            'status' => 'Unpaid', //default status of invoices is unpaid
            'status_value' => 2, //2 referes to unpaid invoices
            'note' => $request->note,
            'user' => auth()->user()->name
        ]);
        //now we should add file and create data into the invoice attachment table
        if ($request->hasFile('file')) {
            //after adding the invoiceDetails we should get the latest id entered in the invoices table
            $invoice_id = $this->invoiceModel::latest()->first()->id;
            $invoice_number = $request->invoice_number;
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $this->uploadFiles($file, 'Attachments/' . $invoice_number, $fileName);
            $this->invoiceAttachmentModel::create([
                'file_name' => $fileName,
                'invoice_number' => $request->invoice_number,
                'invoice_id' => $invoice_id,
                'created_by' => auth()->user()->name

            ]);
        }
        return redirect(route('invoices.index'))->with('success', 'Invoice Has Been Added Successfully');
    }

    public function edit($invoiceId)
    {
        $invoice = $this->getInvoiceById($invoiceId);
        $departments = $this->getAllDepartments();
        return view('invoices.edit', compact('invoice', 'departments'));
    }

    public function update($request)
    {
        $invoice = $this->getInvoiceById($request->invoice_id);
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'collection_amount' => $request->collection_amount,
            'commission_value' => $request->commission_value,
            'department_id' => $request->department_id,
            'discount' => $request->discount,
            'tax_rate' => $request->tax_rate,
            'tax_value' => $request->tax_value,
            'total' => $request->total,
            'note' => $request->note,

        ]);
        $invoice_id = $this->invoiceModel::latest()->first()->id;
        $this->invoiceDetailsModel::where('invoice_id', $invoice_id)->update([
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'department' => $request->department_id,
            'note' => $request->note,
            'user' => auth()->user()->name

        ]);

        $invoice_id = $this->invoiceModel::latest()->first()->id;
        $this->invoiceAttachmentModel::where('invoice_id', $invoice_id)->update([
            'invoice_number' => $request->invoice_number,
            'invoice_id' => $invoice_id,
            'created_by' => auth()->user()->name

        ]);
        return redirect(route('invoices.index'))->with('success', 'Invoice Has Been Updated Successfully');
    }

    public function destroy($request)
    {
        $invoice = $this->getInvoiceById($request->invoice_id);
        //we get the invoice id so we can delete the attachment related to this id
        $invoice_id = $this->invoiceModel::latest()->first()->id;
        // $invoice_id = $request->invoice_id;
        $invoiceAttachment = $this->invoiceAttachmentModel::where('invoice_id', $invoice_id)->first();
        if (!empty($invoiceAttachment->file_name)) {
            Storage::disk('public_uploads')->deleteDirectory($invoiceAttachment->invoice_number);
        }
        $invoice->forceDelete();
        session()->flash('delete_invoice');
        return redirect(route('invoices.index'));
    }

    public function showStatus($invoiceId)
    {
        $invoices = $this->getInvoiceById($invoiceId);
        return view('invoices.invoiceStatus', compact('invoices'));
    }

    public function updateInvoiceStatus($request)
    {
        $invoice = $this->getInvoiceById($request->invoice_id);

        if ($request->status === "paid") {
            $invoice->update([
                'status_value' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);

            $this->invoiceDetailsModel->create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'department' => $request->department_id,
                'status' => $request->status,
                'status_value' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => auth()->user()->name

            ]);
        } else {
            $invoice->update([
                'status' => $request->status,
                'status_value' => 3,
                'payment_date' => $request->payment_date
            ]);

            $this->invoiceDetailsModel->create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'department' => $request->department_id,
                'status' => $request->status,
                'status_value' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => auth()->user()->name

            ]);
        }
        session()->flash('updateInvoiceStatus');
        return redirect(route('invoices.index'));
    }

    public function showPaidInvoices()
    {
        $invoices = $this->invoiceModel::where('status_value', 1)->get();
        return view('invoices.paidInvoices', compact('invoices'));
    }

    public function showUnpaidInvoices()
    {
        
        $invoices = $this->invoiceModel::where('status_value', 2)->get();
        return view('invoices.unpaidInvoices', compact('invoices'));

    }

    public function showPartlyPaidInvoices()
    {
        
        $invoices = $this->invoiceModel::where('status_value', 3)->get();
        return view('invoices.partlyPaidInvoices', compact('invoices'));

    }

    public function archiveInvoices($request)
    {
        $invoice = $this->getInvoiceById($request->invoice_id);
        $invoice->delete();
        session()->flash('archiveInvoice');
        return redirect(route('archivedInvoices.index'));

    }

    public function showInvoicePrintPage($invoiceId)
    {
        $invoices = $this->getInvoiceById($invoiceId)->where('id', $invoiceId)->first();
        return view('invoices.print', compact('invoices'));
    }

   

   

}
