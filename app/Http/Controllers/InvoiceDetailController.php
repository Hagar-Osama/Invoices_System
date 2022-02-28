<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\InvoiceDetailsInterface;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
{
    private $invoiceDetailsInterface;

    public function __construct(InvoiceDetailsInterface $invoiceDetails)
    {
        $this->invoiceDetailsInterface = $invoiceDetails;

    }

    public function index($id)
    {
        return $this->invoiceDetailsInterface->index($id);
    }
}
