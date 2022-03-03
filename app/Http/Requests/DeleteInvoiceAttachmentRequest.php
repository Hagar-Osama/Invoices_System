<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteInvoiceAttachmentRequest extends FormRequest
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
            'id_file' => 'required|exists:invoice_attachment,id',
            'invoice_number' => 'required|exists:invoice_attachment,invoice_number',
            'file_name' => 'required|exists:invoice_attachment,file_name',
        ];
    }
}
