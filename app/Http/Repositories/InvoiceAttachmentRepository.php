<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\InvoiceAttachmentInterface;
use App\Http\Traits\InvoiceAttachmentTrait;
use App\Models\InvoiceAttachment;

class InvoiceAttachmentRepository implements InvoiceAttachmentInterface
{
    use InvoiceAttachmentTrait;
    private $invoiceAttachmentModel;
    public function __construct(InvoiceAttachment $invoiceAttachment)
    {
        $this->invoiceAttachmentModel = $invoiceAttachment;
    }

    public function index()
    {
        return view('');
    }

    public function store($request)
    {
        $this->invoiceAttachmentModel::create([

        ]);
    }
}
