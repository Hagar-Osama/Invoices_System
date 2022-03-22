<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ReportsInterface;
use App\Models\Invoice;

class ReportsRepository implements ReportsInterface
{
    private $invoicesModel;
    public function __construct(Invoice $invoices)
    {
        $this->invoicesModel = $invoices;
    }
    public function index()
    {
        return view('reports.invoicesReports');
    }

    public function search($request)
    {

        //searching by Invoice type(payment status)
        $radio = $request->radio;
        ///1 is the value in the radio button
        //incase no date selected
        if ($radio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {
                $invoices = $this->invoicesModel::select('*')->where('status', '=', $request->type)->get();
                //will put type in varaiable so we can show it in the blade in the select section
                $type = $request->type;
                return view('reports.invoicesReports', compact('type'))->withDetails($invoices);
                //incase there is date selected
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;
                $invoices = $this->invoicesModel::whereBetween('invoice_date', [$start_at, $end_at])
                    ->where('status', '=', $request->type)->get();
                return view('reports.invoicesReports', compact('type', 'start_at', 'end_at'))->withDetails($invoices);
            }
        }
        else {

            //when searching by invoice number
            $invoices = $this->invoicesModel::select('*')->where('invoice_number','=', $request->invoice_number)->get();
            return view('reports.invoicesReports')->withDetails($invoices);
        }
    }
}
