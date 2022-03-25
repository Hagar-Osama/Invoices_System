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

        $paidInvoicesPercentage = round($paidInvoicesCount / $invoicesCount * 100);
        $unpaidInvoicesPercentage = round($unpaidInvoicesCount / $invoicesCount * 100);
        $partialyPaidInvoicesPercentage = round($partialyPaidInvoicesCount / $invoicesCount * 100);

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
        return view('dashboard', compact('chartjs', 'invoices'));
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
