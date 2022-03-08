@extends('layouts.master')
@section('css')
@endsection
@section('title')
Change Invoice Status
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Change Invoice Status
            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('invoiceStatus.update')}}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    {{-- 1 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label"> Invoice Number</label>
                            <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                            <input type="text" class="form-control" id="inputName" name="invoice_number" title="يرجي ادخال رقم الفاتورة" value="{{ $invoices->invoice_number }}" required readonly>
                        </div>

                        <div class="col">
                            <label> Invoice Date</label>
                            <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD" type="text" value="{{ $invoices->invoice_Date }}" required readonly>
                        </div>

                        <div class="col">
                            <label> Due Date</label>
                            <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" type="text" value="{{ $invoices->Due_date }}" required readonly>
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Department</label>
                            <select name="department_id" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')" readonly>
                                <!--placeholder-->
                                <option value=" {{ $invoices->department->id }}">
                                    {{ $invoices->department->name }}
                                </option>

                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Product</label>
                            <select id="product" name="product" class="form-control" readonly>
                                <option value="{{ $invoices->product }}"> {{ $invoices->product }}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label"> Collection Amount</label>
                            <input type="text" class="form-control" id="inputName" name="collection_amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->collection_amount }}" readonly>
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">Commission Value</label>
                            <input type="text" class="form-control form-control-lg" id="Amount_Commission" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->commission_value }}" required readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Discount</label>
                            <input type="text" class="form-control form-control-lg" id="Discount" name="discount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->discount }}" required readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label"> Tax Rate</label>
                            <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()" readonly>
                                <!--placeholder-->
                                <option value=" {{ $invoices->tax_rate }}">
                                    {{ $invoices->tax_rate }}
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Tax Value</label>
                            <input type="text" class="form-control" id="Value_VAT" name="tax_value" value="{{ $invoices->tax_value }}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Total</label>
                            <input type="text" class="form-control" id="Total" name="total" readonly value="{{ $invoices->total }}">
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Notes</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                            {{ $invoices->note }}</textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea"> Payment Status</label>
                            <select class="form-control" id="Status" name="status" required>
                                <option selected="true" disabled="disabled">-- Choose Payment Status --</option>
                                <option value="paid">Paid</option>
                                <option value="partly paid"> Partly Paid</option>
                            </select>
                        </div>

                        <div class="col">
                            <label> Payment Date</label>
                            <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD" type="text" required>
                        </div>


                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Change Payment Status</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>
@endsection