<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\ArchiveInterface;
use App\Http\Traits\InvoicesTrait;
use App\Models\Invoice;

class ArchiveRepository implements ArchiveInterface 
{
    use InvoicesTrait;
    private $invoiceModel;
    public function __construct(Invoice $invoice)
    {
        $this->invoiceModel = $invoice;
    }

    public function showArchivedInvoices()
    {
        
        $invoices = $this->invoiceModel->onlyTrashed()->get();
        return view('invoices.archivedInvoices', compact('invoices'));

    }

    public function updateArchives($request)
    {
        $invoiceId = $request->invoice_id;
        $this->invoiceModel::withTrashed()->where('id', $invoiceId)->restore();
        session()->flash('restoreArchiveInvoice');
        return redirect(route('invoices.index'));

    }

    public function destroy($request)
    {
        $invoice = $this->invoiceModel::withTrashed()->where('id',$request->invoice_id)->first();
        $invoice->forceDelete();
        session()->flash('delete_invoice');
        return redirect(route('archivedInvoices.index'));

    }
}