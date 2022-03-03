<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\InvoiceAttachmentInterface;
use App\Http\Requests\DeleteInvoiceAttachmentRequest;
use App\Http\Traits\InvoiceAttachmentTrait;
use App\Models\InvoiceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachmentRepository implements InvoiceAttachmentInterface
{
    use InvoiceAttachmentTrait;
    private $invoiceAttachmentModel;
    public function __construct(InvoiceAttachment $invoiceAttachment)
    {
        $this->invoiceAttachmentModel = $invoiceAttachment;
    }

    public function openFile($invoiceNumber, $fileName)
    {
        //public_path = get the path to public folder
        // $file = public_path( 'Attachments/'.$invoiceNumber. '/'. $fileName);
        //get the path to the storage
        $file = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoiceNumber. '/' . $fileName);
        return response()->file($file);

    }

    public function downloadFile($invoiceNumber, $fileName)
    {
        //public_path = get the path to public folder
        // $file = public_path( 'Attachments/'.$invoiceNumber. '/'. $fileName);
        //get the path to the storage
        $file = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoiceNumber. '/' . $fileName);
        return response()->download($file);

    }

    public function destroy($request)
    {
        $file = $this->getInvoiceAttachmentById($request->id_file);
        //to delete it from database
        $file->delete();
        Storage::disk('public_uploads')->delete(request()->invoiceNumber. '/' . request()->fileName);

        return redirect()->back()->with('success', 'file deleted successfully');
    }

}
