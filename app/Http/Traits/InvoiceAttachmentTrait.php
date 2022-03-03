<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait InvoiceAttachmentTrait {

    public function uploadFiles($file, $path, $fileName, $oldfile = null)
    {
        //this code without the storage link
       $file->move(public_path($path), $fileName);

       //this code when storage link is created
    //    Storage::disk('public')->put($path, $file);//$path= attachments, $file= file from the request
        if(! is_null($oldfile)) {
            unlink(public_path($oldfile));
        }
    }

    public function getAllInvoiceAttachment($invoiceId)
    {
        return $this->invoiceAttachmentModel::where('invoice_id', $invoiceId)->get();

    }

    public function getInvoiceAttachmentById($fileId)
    {
        return $this->invoiceAttachmentModel::find($fileId);

    }
}
