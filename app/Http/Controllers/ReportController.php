<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ReportsInterface;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $reportsInterface;

    public function __construct(ReportsInterface $reports)
    {
        $this->reportsInterface = $reports;

    }

    public function index()
    {
        return $this->reportsInterface->index();
    }

    public function search(Request $request)
    {
        return $this->reportsInterface->search($request);
    }
}
