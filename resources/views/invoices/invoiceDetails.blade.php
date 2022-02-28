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
                                        <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> Invoice Number</a></li>
                                        <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cogs"></i> Product</a></li>
                                        <li><a href="#tab13" data-toggle="tab"><i class="fa fa-tasks"></i> Department Name</a></li>
                                        <li><a href="#tab14" data-toggle="tab"><i class="fa fa-tasks"></i> Sataus</a></li>
                                        <li><a href="#tab15" data-toggle="tab"><i class="fa fa-tasks"></i> Invoice Attachment</a></li>
                                        <li><a href="#tab16" data-toggle="tab"><i class="fa fa-tasks"></i> User</a></li>



                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                @isset($invoiceDetail, $invoice_attachment)

                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab11">
                                        <p>{{$invoiceDetail->invoice_number}}</p>
                                    </div>
                                    <div class="tab-pane" id="tab12">
                                        <p> {{$invoiceDetail->product}}</p>
                                    </div>
                                    <div class="tab-pane" id="tab13">
                                        <p>{{$invoiceDetail->invoice->department->name}}</p>
                                    </div>
                                    <div class="tab-pane" id="tab14">
                                        <p>@if($invoiceDetail->status_value == 1)
                                            <span class="text-success">{{$invoiceDetail->status}}</span>
                                            @elseif($invoiceDetail->status_value == 2)
                                            <span class="text-danger">{{$invoiceDetail->status}}</span>
                                            @else
                                            <span class="text-warning">{{$invoiceDetail->status}}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab15">
                                        <img src="{{asset('attachments/invoices/'.$invoice_attachment->file_name)}}" height="200px">
                                    </div>
                                    <div class="tab-pane" id="tab16">
                                        <p>{{$invoiceDetail->user}}</p>
                                    </div>
                                </div>
                                @endisset
                            </div>
                        </div>
                    </div>

                    <!---Prism Pre code-->

                    <!---Prism Pre code-->
                </div>
            </div>
        </div>
    </div>
    <!-- /div -->


</div>

</div>
<!-- /row -->
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
@endsection
