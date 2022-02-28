<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\InvoicesInterface;
use App\Http\Requests\AddInvoiceAttachmentRequest;
use App\Http\Requests\AddInvoicesRequest;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    private $invoicesInterface;
    public function __construct(InvoicesInterface $invoices)
    {
        $this->invoicesInterface = $invoices;

    }

    public function index()
    {
        return $this->invoicesInterface->index();
    }

    public function create()
    {
        return $this->invoicesInterface->create();
    }

    public function getProduct($id)
    {
        return $this->invoicesInterface->getProduct($id);
    }

    public function store(AddInvoicesRequest $request)
    {
        return $this->invoicesInterface->store($request);

    }
}
