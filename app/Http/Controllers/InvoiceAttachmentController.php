<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\InvoiceAttachmentInterface;
use App\Http\Requests\AddInvoiceAttachmentRequest;
use Illuminate\Http\Request;

class InvoiceAttachmentController extends Controller
{
    private $invoiceAttachmentInterface;

    public function __construct(InvoiceAttachmentInterface $invoiceAttachment)
    {
        $this->invoiceAttachmentInterface = $invoiceAttachment;

    }

    public function index()
    {
        return $this->invoiceAttachmentInterface->index();
    }

    public function store( $request)
    {
        return $this->invoiceAttachmentInterface->store($request);
    }
}
