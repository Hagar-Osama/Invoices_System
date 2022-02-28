<?php
namespace App\Http\Traits;

trait InvoicesTrait {

    public function getAllInvoices()
    {
        return $this->invoiceModel::get();
    }
}
