<?php
namespace App\Http\Traits;

trait InvoicesTrait {

    public function getAllInvoices()
    {
        return $this->invoiceModel::get();
    }

    public function getInvoice($invoiceId)
    {
        return $this->invoiceModel::where('id', $invoiceId)->first();
    }
}
