<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\InvoiceDetailsInterface;
use App\Http\Traits\InvoiceAttachmentTrait;
use App\Http\Traits\InvoiceDetailsTrait;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;

class InvoiceDetailsRepository implements InvoiceDetailsInterface
{
    use InvoiceDetailsTrait;
    use InvoiceAttachmentTrait;
    private $invoiceDetailsModel;

    public function __construct(InvoiceDetail $invoiceDetails)
    {
        $this->invoiceDetailsModel = $invoiceDetails;

    }

    public function index($invoiceId)
    {
        //we are using the invoice id to select the invoice details and show it
        $invoiceDetail = $this->getAllInvoiceDetails($invoiceId);
        $invoice_attachment =$this->getInvoiceAttachment($invoiceId);
        return view('invoices.invoiceDetails', compact('invoiceDetail', 'invoice_attachment'));
    }
}
