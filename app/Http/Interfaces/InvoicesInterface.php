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
}
