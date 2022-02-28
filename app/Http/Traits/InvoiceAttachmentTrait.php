<?php
namespace App\Http\Traits;

trait InvoiceAttachmentTrait {

    public function uploadFiles($file, $path, $fileName, $oldfile = null)
    {
        $file->move(public_path('attachments/'.$path), $fileName);
        if(! is_null($oldfile)) {
            unlink(public_path($oldfile));
        }
    }

    public function getInvoiceAttachment($invoiceId)
    {
        return $this->invoiceDetailsModel::where('invoice_id', $invoiceId)->first();

    }
}
