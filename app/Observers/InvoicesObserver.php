<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\User;
use App\Notifications\AddedInvoice;
use App\Notifications\newInvoiceAdded;
use Illuminate\Support\Facades\Notification;

class InvoicesObserver
{
    private $invoiceModel;
    private $userModel;

    public function __construct(Invoice $invoice, User $user)
    {
        $this->invoiceModel = $invoice;
        $this->userModel = $user;
    }
    /**
     * Handle the Invoice "created" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        $user = $this->userModel::get();//if u want to make the notification goes to the maker only use find(auth()->user()->id)
        $invoices = $this->invoiceModel::latest()->first();
        Notification::send($user, new newInvoiceAdded($invoices));

    }

    public function creating(Invoice $invoice)
    {
        // $invoice_id = $this->invoiceModel::latest()->first()->id;
        // $user = $this->userModel::first();
        // Notification::send($user, new AddedInvoice($invoice_id));
    }

    /**
     * Handle the Invoice "updated" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
