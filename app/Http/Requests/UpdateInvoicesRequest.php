<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             //invoices and invoiceDetails validation
             'invoice_id' => 'required|exists:invoices,id',
             'invoice_number' => 'required',
             'invoice_date' => 'required',
             'due_date' => 'required',
             'product' => 'required',
             'collection_amount' => 'required',
             'commission_value' => 'required',
             'department_id' => 'required|exists:departments,id',
             'discount' => 'required',
             'tax_rate' => 'required',
             'tax_value' => 'required',
             'total' => 'required',
             'note' => 'required',

        ];
    }
}
