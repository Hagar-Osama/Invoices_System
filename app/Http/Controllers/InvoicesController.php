<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\InvoicesInterface;
use App\Http\Requests\AddInvoicesRequest;
use App\Http\Requests\DeleteInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Http\Requests\UpdateInvoiceStatusRequest;

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

    public function getProduct($depId)
    {
        return $this->invoicesInterface->getProduct($depId);
    }

    public function store(AddInvoicesRequest $request)
    {
        return $this->invoicesInterface->store($request);

    }

    public function edit($invoiceId)
    {
        return $this->invoicesInterface->edit($invoiceId);
    }

    public function update(UpdateInvoicesRequest $request)
    {
        return $this->invoicesInterface->update($request);
    }

    public function destroy(DeleteInvoicesRequest $request)
    {
        return $this->invoicesInterface->destroy($request);
    }

    public function showStatus($invoiceId)
    {
        return $this->invoicesInterface->showStatus($invoiceId);
    }

    public function updateInvoiceStatus(UpdateInvoiceStatusRequest $request)
    {
        return $this->invoicesInterface->updateInvoiceStatus($request);
    }

    public function showPaidInvoices()
    {
        return $this->invoicesInterface->showPaidInvoices();
    }

    public function showUnpaidInvoices()
    {
        return $this->invoicesInterface->showUnpaidInvoices();
    }

    public function showPartlyPaidInvoices()
    {
        return $this->invoicesInterface->showPartlyPaidInvoices();
    }

    public function archiveInvoices(DeleteInvoicesRequest $request)
    {
        return $this->invoicesInterface->archiveInvoices($request);
    }

    public function showInvoicePrintPage($invoiceId)
    {
        return $this->invoicesInterface->showInvoicePrintPage($invoiceId);
    }

   
}
