<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\InvoiceDetailsInterface;
use App\Http\Traits\InvoiceAttachmentTrait;
use App\Http\Traits\InvoiceDetailsTrait;
use App\Http\Traits\InvoicesTrait;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;

class InvoiceDetailsRepository implements InvoiceDetailsInterface
{
    use InvoiceDetailsTrait;
    use InvoiceAttachmentTrait;
    use InvoicesTrait;
    private $invoiceDetailsModel;
    private $invoiceAttachmentModel;
    private $invoiceModel;

    public function __construct(InvoiceDetail $invoiceDetails, InvoiceAttachment $invoiceAttachment, Invoice $invoice)
    {
        $this->invoiceDetailsModel = $invoiceDetails;
        $this->invoiceAttachmentModel = $invoiceAttachment;
        $this->invoiceModel = $invoice;
    }

    public function index($invoiceId)
    {
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        if ($userUnreadNotifications) {
            $userUnreadNotifications->markAsRead();
        }
        //we are using the invoice id to select the invoice details and invoice attachment and show it
        $invoice = $this->getInvoice($invoiceId);
        $invoiceDetails = $this->getAllInvoiceDetails($invoiceId);
        $invoiceAttachments = $this->getAllInvoiceAttachment($invoiceId);
        return view('invoices.invoiceDetails', compact('invoice', 'invoiceDetails', 'invoiceAttachments'));
    }
}
