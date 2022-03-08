@extends('layouts.master')
@section('title')
Unpaid Invoices
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
@if (session()->has('delete_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "Invoice Deleted Successfully",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('updateInvoiceStatus'))
<script>
    window.onload = function() {
        notif({
            msg: "Invoice Payment Status Updated Successfully",
            type: "success"
        })
    }
</script>
@endif
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Unpaid Invoices List</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">

                <a href="{{route('invoices.create')}}" class="btn btn-info">Add Invoices</a>
            </div>
            @include('partials.session')
            @include('partials._errors')

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Invoice Number</th>
                                <th class="border-bottom-0">Invoice Date</th>
                                <th class="border-bottom-0">Due Date</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">Department Name</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Tax Rate</th>
                                <th class="border-bottom-0">Tax Value</th>
                                <th class="border-bottom-0">Total</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Note</th>
                                <th class="border-bottom-0">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            @isset($invoices)
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td><a href="{{route('invoiceDetails.index', [$invoice->id])}}">{{$invoice->invoice_number}}</a></td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->due_date}}</td>
                                <td>{{$invoice->product}}</td>
                                <td>{{$invoice->department->name}}</td>
                                <td>{{$invoice->discount}}</td>
                                <td>{{$invoice->tax_rate}}</td>
                                <td>{{$invoice->tax_value}}</td>
                                <td>{{$invoice->total}}</td>
                                <td>
                                    @if($invoice->status_value == 1)
                                    <span class="text-success">{{$invoice->status}}</span>
                                    @elseif($invoice->status_value == 2)
                                    <span class="text-danger">{{$invoice->status}}</span>
                                    @else
                                    <span class="text-warning">{{$invoice->status}}</span>
                                    @endif


                                </td>
                                <td>{{$invoice->note}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Actions<i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            <a class="dropdown-item" href=" {{ route('invoice.edit', [$invoice->id]) }}">Edit
                                                Invoice</a>
                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}" data-toggle="modal" data-target="#delete_invoice"><i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;Delete
                                                Invoice</a>
                                            <a class="dropdown-item" href="{{ URL::route('invoiceStatus.show', [$invoice->id]) }}"><i class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                Payment Status
                                                </a>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->

    <!-- Delete Invoice  -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoice.destroy') }}" method="post">
                        @method('Delete')
                        @csrf
                </div>
                <div class="modal-body">
                    Are You Sure You Want To Delete This?
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
    $('#delete_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>
@endsection