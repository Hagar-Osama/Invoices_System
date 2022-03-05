<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\InvoiceAttachmentInterface;
use App\Http\Requests\AddInvoiceAttachmentRequest;
use App\Http\Requests\DeleteInvoiceAttachmentRequest;
use Illuminate\Http\Request;

class InvoiceAttachmentController extends Controller
{
    private $invoiceAttachmentInterface;

    public function __construct(InvoiceAttachmentInterface $invoiceAttachment)
    {
        $this->invoiceAttachmentInterface = $invoiceAttachment;

    }

    public function openFile($invoiceNumber, $fileName)
    {
        return $this->invoiceAttachmentInterface->openfile($invoiceNumber, $fileName);

    }

    public function downloadFile($invoiceNumber, $fileName)
    {
        return $this->invoiceAttachmentInterface->downloadfile($invoiceNumber, $fileName);

    }

    public function destroy(DeleteInvoiceAttachmentRequest $request)
    {
        return $this->invoiceAttachmentInterface->destroy($request);
    }

    public function store(AddInvoiceAttachmentRequest $request)
    {
        return $this->invoiceAttachmentInterface->store($request);
    }




}
