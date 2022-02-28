<?php
namespace App\Http\Interfaces;

interface InvoiceAttachmentInterface {

    public function index();

    public function store($request);
}
