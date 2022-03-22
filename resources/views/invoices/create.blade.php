@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
Adding Invoices
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Adding Invoices
            </span>
        </div>
    </div>
</div>
@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
<!-- breadcrumb -->
@endsection
@section('content')



<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('invoices.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    {{-- 1 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Invoice Number</label>
                            <input type="text" class="form-control" id="inputName" name="invoice_number" title="Enter Invoice Number" required>
                        </div>

                        <div class="col">
                            <label>Invoice Date</label>
                            <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD" type="text" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col">
                            <label>Due Date</label>
                            <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" type="text" required>
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Departments</label>
                            <select name="department_id" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                <!--placeholder-->
                                <option value="" selected disabled>Choose Department</option>
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Product</label>
                            <select id="product" name="product" class="form-control">
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label"> Collection Amount</label>
                            <input type="text" class="form-control" id="inputName" name="collection_amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">Commission Value</label>
                            <input type="text" class="form-control form-control-lg" id="Amount_Commission" name="commission_value" title="Enter Commission Value " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Discount</label>
                            <input type="text" class="form-control form-control-lg" id="discount" name="discount" title="Enter Discount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value=0 required>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Tax Rate</label>
                            <select name="tax_rate" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                <!--placeholder-->
                                <option value="" selected disabled>Choose Tax Rate</option>
                                <option value="5%">5%</option>
                                <option value="10%">10%</option>
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Tax Value</label>
                            <input type="text" class="form-control" id="Value_VAT" name="tax_value" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Total</label>
                            <input type="text" class="form-control" id="Total" name="total" readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Notes</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                        </div>
                    </div><br>

                    <p class="text-danger">* File Formate pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">Files</h5>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="file" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>


                </form>
            </div>
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
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
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

<script>
    //when page is ready and loaded
    $(document).ready(function() {
        //when we make changes in department part and choose a department
            $('select[name="department_id"]').on('change', function() {
               // create a variable and assign the value of the department id we choose in it
                var departmentId = $(this).val();
                //if the id is true go to the url with the id coming
                if (departmentId) {
                    $.ajax({
                        url: "{{ URL::to('department') }}/" + departmentId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            //product field in the page is empty
                            $('select[name="product"]').empty();
                            //make for each on the value which is the product name which comes from the pluck from getProduct method
                            //and put it in option value=""
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
</script>

<script>
        function myFunction() {
            var Commission_Value = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("discount").value);
            var Tax_Rate = parseFloat(document.getElementById("Rate_VAT").value);
            var Tax_Value = parseFloat(document.getElementById("Value_VAT").value);
            var Commission_Value2 = Commission_Value - Discount;
            if (typeof Commission_Value === 'undefined' || ! Commission_Value) {
                alert('  Please Enter Commission Value  ');
            } else {
                var intResults = Commission_Value2 * Tax_Rate / 100;
                var intResults2 = parseFloat(intResults + Commission_Value2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
            }
        }
    </script>

@endsection
