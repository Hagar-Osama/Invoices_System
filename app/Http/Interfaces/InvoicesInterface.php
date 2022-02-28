<?php
namespace App\Http\Interfaces;

interface InvoicesInterface {

    public function index();

    public function create();

    public function getProduct($id);

    public function store($request);
}
