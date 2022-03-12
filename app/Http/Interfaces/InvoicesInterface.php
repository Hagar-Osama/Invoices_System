<?php
namespace App\Http\Interfaces;

interface InvoicesInterface {

    public function index();

    public function create();

    public function getProduct($depId);

    public function store($request);

    public function edit($invoiceId);

    public function update($request);

    public function destroy($request);

    public function showStatus($invoiceId);

    public function updateInvoiceStatus($request);

    public function showPaidInvoices();

    public function showUnpaidInvoices();

    public function showPartlyPaidInvoices();

    public function archiveInvoices($request);

    public function showInvoicePrintPage($invoiceId);

    public function export();






}
