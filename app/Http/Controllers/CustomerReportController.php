<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CustomersReportsInterface;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    private $customersReportsInterface;

    public function __construct(CustomersReportsInterface $reports)
    {
        $this->customersReportsInterface = $reports;

    }

    public function index()
    {
        return $this->customersReportsInterface->index();
    }

    public function search(Request $request)
    {
        return $this->customersReportsInterface->search($request);
    }
}
