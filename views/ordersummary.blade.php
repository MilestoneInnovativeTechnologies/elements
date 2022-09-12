<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    @include('Elements::head')
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('Elements::menu')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('Elements::topbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Order Summary </h4>

                    <div class="row mb-5">
                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">Document Id</label>
                                <input class="form-control" type="text" name="id">
                            </div>
                            <br>
                            {{--                                            <span style="color:red">@error('firstname'){{$message}}@enderror</span>--}}
                            <div class="col-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" type="date" name="dob">
                            </div>
                            <br>
                            <div class=" col-md-2">
                                <label class="form-label">Invoice Discount</label>
                                <input type="number"  class="form-control"  name="invoicediscount" >
                            </div>
                            <br>
                            {{--                                            <span style="color:red">@error('lastName'){{$message}}@enderror</span>--}}
                            <div class="col-3">
                                <label class="form-label">Sales Executive</label>
                                <input class="form-control" type="text" id="salesexecutive" name="salesexecutive"  >
                            </div>
                            <span style="color:red">@error('salesexecutive'){{$message}}@enderror</span>
                            <br><br>
                            <div class="col-2">
                                <label  class="form-label">Reference Number</label>
                                <input type="number" class="form-control" id="referencenumber" name="referencenumber" >
                            </div>
                            <span style="color:red">@error('referencenumber'){{$message}}@enderror</span>
                            <br>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Payment Mode</label>
                                <br>
                                <input type="radio" value="yes" id="cash" name="paymentmode" >
                                <label for="cash">cash</label>
                                <input type="radio" value="credit" id="credit" name="paymentmode">
                                <label for="credit">credit</label>
                                <br>
                                <br>



                            <div class="mb-3 col-md-6">
                                <label class="form-label">Foc Tax</label>
                                <br>


                                <input type="radio" value="yes"  name="foctax" >
                                <label for="yes">Yes</label>
                                <input type="radio" value="no" name="foctax">
                                <label for="no">No</label>

                            </div>

{{--                            <div class=" col-md-2">--}}
{{--                                <label class="form-label">Invoice Discount</label>--}}
{{--                                <input type="number"  class="form-control"  name="invoicediscount" >--}}
{{--                            </div>--}}


                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status</label>
                                <br>


                                <input type="radio"   value="pending"  name="status">
                                <label for="pending">Pending</label>
                                <input type="radio" value="confirmed" name="status" >
                                <label for="confirmed">Confirmed</label>
                                <input type="radio" value="approved"  name="status" >
                                <label for="approved">Approved</label>
                                <input type="radio" value="cancelled"  name="status" >
                                <label for="cancelled">Cancelled</label>


                            </div>
                        </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Order Details</h5>
                        </div>
                    </div>
{{--
                    </div>
{{--                        <div class="mt-2">--}}
{{--                            <button type="submit" class="btn btn-success me-2">Submit</button>--}}
{{--                            <button type="cancel" class="btn btn-primary me-1">Cancel</button>--}}
{{--                        </div>--}}
                    <div class="mt-2">
                        <a href="{{url('orderhistory')}}" class="btn btn-success btn-lg ">Submit</a>
                        <a href="{{url('customerdetails')}}" class="btn btn-primary btn-lg">Cancel</a>
                    </div>


                    </div>
{{--                    <div class="row mt-3">--}}
{{--                        <div class="d-grid gap-2 col-lg-6 mx-auto">--}}
{{--                            <button class="btn btn-primary " type="button">Submit</button>--}}
{{--                            <button class="btn btn-primary " type="button">Cancel</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <!-- / Content -->

                <!-- Footer -->
                @include('Elements::footer')
                <!-- / Footer -->

            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->

</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

@include('Elements::tail')
</body>
</html>
