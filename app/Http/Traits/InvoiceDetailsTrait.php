<?php
namespace App\Http\Traits;

trait InvoiceDetailsTrait {

    public function getAllInvoiceDetails($invoiceId)
    {
        return $this->invoiceDetailsModel::where('invoice_id', $invoiceId)->first();
    }
}
