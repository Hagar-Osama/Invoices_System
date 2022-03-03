@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice Details & Attachment</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row opened -->
@include('partials.session')
@include('partials._errors')
<div class="row row-sm">
    <div class="col-xl-12">
        <!-- div -->
        <div class="card mg-b-20" id="tabs-style3">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Invoice Details and Attachment
                </div>
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-3">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu ">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> Invoice Information</a></li>
                                        <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cogs"></i> Payment Status</a></li>
                                        <li><a href="#tab13" data-toggle="tab"><i class="fa fa-tasks"></i> Invoice Attachment</a></li>



                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab11">
                                        <div class="table-responsive mt-15">
                                            <table class="table table-striped" style="text-align:center">
                                                <tbody>
                                                    @isset($invoice)

                                                    <tr>
                                                        <th scope="row">Invoice Number</th>
                                                        <td>{{$invoice->invoice_number}}</td>
                                                        <th scope="row">Invoice Date</th>
                                                        <td>{{$invoice->invoice_date}}</td>
                                                        <th scope="row">Due Date</th>
                                                        <td>{{$invoice->due_date}}</td>
                                                        <th scope="row">Product</th>
                                                        <td>{{$invoice->product}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Department Name</th>
                                                        <td>{{$invoice->department->name}}</td>
                                                        <th scope="row">Discount</th>
                                                        <td>{{$invoice->discount}}</td>
                                                        <th scope="row">Tax Rate</th>
                                                        <td>{{$invoice->tax_rate}}</td>
                                                        <th scope="row">Tax Value</th>
                                                        <td>{{$invoice->tax_value}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Collection Amount</th>
                                                        <td>{{$invoice->collection_amount}}</td>
                                                        <th scope="row">Commission Value</th>
                                                        <td>{{$invoice->commission_value}}</td>
                                                        <th scope="row">Total</th>
                                                        <td>{{$invoice->total}}</td>
                                                        <th scope="row">Status</th>

                                                        @if($invoice->status_value == 1)
                                                        <td><span class="badge bagde-pill badge-success">{{$invoice->status}}</span></td>
                                                        @elseif($invoice->status_value == 2)
                                                        <td><span class="badge bagde-pill badge-danger">{{$invoice->status}}</span></td>
                                                        @else
                                                        <td><span class="badge bagde-pill badge-warning">{{$invoice->status}}</span></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Note</th>
                                                        <td>{{$invoice->note}}</td>

                                                    </tr>
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="tab12">
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table-hover" style="text-align:center">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">#</th>
                                                        <th class="border-bottom-0">Invoice Number</th>
                                                        <th class="border-bottom-0">Product</th>
                                                        <th class="border-bottom-0">Department Name</th>
                                                        <th class="border-bottom-0">Status</th>
                                                        <th class="border-bottom-0">Payment Date</th>
                                                        <th class="border-bottom-0">User</th>
                                                        <th class="border-bottom-0">Note</th>
                                                        <th class="border-bottom-0">Created At</th>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $counter = 1; ?>
                                                    @isset($invoiceDetails)
                                                    @foreach($invoiceDetails as $invoiceDetail)

                                                    <tr>
                                                        <td>{{$counter++}}</td>
                                                        <td>{{$invoiceDetail->invoice_number}}</td>
                                                        <td>{{$invoiceDetail->product}}</td>
                                                        <td>{{$invoiceDetail->invoice->department->name}}</td>
                                                        <td>
                                                            @if($invoiceDetail->status_value == 1)
                                                            <span class="text-success">{{$invoiceDetail->status}}</span>
                                                            @elseif($invoiceDetail->status_value == 2)
                                                            <span class="text-danger">{{$invoiceDetail->status}}</span>
                                                            @else
                                                            <span class="text-warning">{{$invoiceDetail->status}}</span>
                                                            @endif


                                                        </td>
                                                        <td>{{$invoiceDetail->Payment_Date}}</td>
                                                        <td>{{$invoiceDetail->user}}</td>
                                                        <td>{{$invoiceDetail->note}}</td>
                                                        <td>{{$invoiceDetail->created_at}}</td>

                                                    </tr>
                                                    @endforeach
                                                    @endisset

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="tab13">
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table-hover" style="text-align:center">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">#</th>
                                                        <th class="border-bottom-0">Invoice Number</th>
                                                        <th class="border-bottom-0">File Name</th>
                                                        <th class="border-bottom-0">Created By</th>
                                                        <th class="border-bottom-0">Actions</th>




                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $counter = 1; ?>
                                                    @isset($invoiceAttachments)
                                                    @foreach($invoiceAttachments as $invoiceAttachment)

                                                    <tr>
                                                        <td>{{$counter++}}</td>
                                                        <td>{{$invoiceAttachment->invoice_number}}</td>
                                                        <td>{{$invoiceAttachment->file_name}}</td>
                                                        <td>{{$invoiceAttachment->created_by}}</td>
                                                        <td colspan="2">

                                                            <a class="btn btn-outline-success btn-sm" href="{{ route('openFile', [$invoiceAttachment->invoice_number, $invoiceAttachment->file_name]) }}" role="button" target="_blank"><i class="fas fa-eye"></i>&nbsp;
                                                                Open</a>
                                                            <a class="btn btn-outline-info btn-sm" href="{{ route('downloadFile', [$invoiceAttachment->invoice_number, $invoiceAttachment->file_name]) }}" role="button" target="_blank"><i class="fas fa-download"></i>&nbsp;
                                                                Download</a>
                                                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-file_name="{{ $invoiceAttachment->file_name }}" data-invoice_number="{{ $invoiceAttachment->invoice_number }}" data-id_file="{{ $invoiceAttachment->id }}" data-target="#delete_file">Delete</button>
                                                        </td>



                                                    </tr>
                                                    @endforeach
                                                    @endisset

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>



                                    <!---Prism Pre code-->

                                    <!---Prism Pre code-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /div -->


</div>

</div>
<!-- /row -->
<!-- delete -->
<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('attachment.destroy')}}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red">Are You Sure You Want To delete This File? </h6>
                    </p>

                    <input type="hidden" name="id_file" id="id_file" value="">
                    <input type="hidden" name="file_name" id="file_name" value="">
                    <input type="hidden" name="invoice_number" id="invoice_number" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)
        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>
@endsection
