<?php
namespace App\Http\Traits;

trait InvoiceDetailsTrait {

    public function getAllInvoiceDetails($invoiceId)
    {
        /* we use get to make for each coz the same invoice id can have several payment status
         so we will for each every status */
        return $this->invoiceDetailsModel::where('invoice_id', $invoiceId)->get();
    }
}
