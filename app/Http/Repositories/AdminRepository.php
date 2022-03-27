<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AdminInterface;
use App\Models\Invoice;

class AdminRepository implements AdminInterface
{
    private $invoiceModel;
    public function __construct(Invoice $invoices)
    {
        $this->invoiceModel = $invoices;
    }

    public function index()
    {
        $invoicesCount = $this->invoiceModel::count();
        $paidInvoicesCount = $this->invoiceModel::where('status_value', 1)->count();
        $unpaidInvoicesCount = $this->invoiceModel::where('status_value', 2)->count();
        $partialyPaidInvoicesCount = $this->invoiceModel::where('status_value', 3)->count();

        if($paidInvoicesCount == 0) {
            $paidInvoicesPercentage = 0;
        }else{
            $paidInvoicesPercentage = round($paidInvoicesCount / $invoicesCount * 100);
        }

        if($unpaidInvoicesCount == 0) {
            $unpaidInvoicesPercentage = 0;
        }else {
            $unpaidInvoicesPercentage = round($unpaidInvoicesCount / $invoicesCount * 100);
        }

        if($partialyPaidInvoicesCount == 0) {
            $partialyPaidInvoicesPercentage = 0;
        }else {
            $partialyPaidInvoicesPercentage = round($partialyPaidInvoicesCount / $invoicesCount * 100);
        }

        $invoices = app()->chartjs
            ->name('lineChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['Paid', 'Unpaid', 'Partialy Paid'])
            ->datasets([
                [
                    "label" => "Paid Invoices",
                    'backgroundColor' => ['#36A2EB'],
                    'data' => [$paidInvoicesPercentage]
                ],
                [
                    "label" => " Unpaid Invoices",
                    'backgroundColor' => ['#FF6384'],
                    'data' => [$unpaidInvoicesPercentage]
                ],
                [
                    "label" => "  Partialy Paid Invoices",
                    'backgroundColor' => ['#FFC234'],
                    'data' => [$partialyPaidInvoicesPercentage]
                ],

            ])
            ->options([]);

        $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Paid', 'Unpaid', 'Partialy Paid'])
            ->datasets([
                [
                    'backgroundColor' => ['#36A2EB', '#FF6384','#FFC234'],
                    'data' => [$paidInvoicesPercentage, $unpaidInvoicesPercentage, $partialyPaidInvoicesCount]
                ]
            ])
            ->options([]);
            // if(view()->exists($id)){
            //     return view($id, compact('chartjs', 'invoices', 'unpaidInvoicesPercentage', 'paidInvoicesPercentage','partialyPaidInvoicesPercentage'));
            // }
            // else
            // {
            //     return view('404');
            // }
        return view('dashboard', compact('chartjs', 'invoices', 'unpaidInvoicesPercentage', 'paidInvoicesPercentage','partialyPaidInvoicesPercentage'));
    }

    public function markAsRead()
    {
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        if($userUnreadNotifications) {
            $userUnreadNotifications->markAsRead();
            return back();
        }
    }
}
