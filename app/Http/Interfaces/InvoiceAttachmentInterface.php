<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface InvoiceAttachmentInterface {

    public function openFile($invoiceNumber, $fileName);

    public function downloadFile($invoiceNumber, $fileName);

    public function destroy($request);

    public function store($request);



}
