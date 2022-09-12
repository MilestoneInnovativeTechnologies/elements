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
                            <div class="mb-3 col-md-2">
                                <label class="form-label">Document Id</label>
                                <input class="form-control" type="text" name="id">
                            </div>
                            {{--                                            <span style="color:red">@error('firstname'){{$message}}@enderror</span>--}}
                            <div class="mb-3 col-md-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" type="date" name="lastName" id="dob">
                            </div>
                            {{--                                            <span style="color:red">@error('lastName'){{$message}}@enderror</span>--}}
                            <div class="mb-3 col-md-3">
                                <label class="form-label">Sales Executive</label>
                                <input class="form-control" type="text" id="sales" name="sales"  >
                            </div>
                            <div class="mb-3 col-md-2">
                                <label  class="form-label">Reference Number</label>
                                <input type="number" class="form-control" id="referencenumber" name="referencenumber" >
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Payment Mode</label>
                                <br>
                                <input type="radio" value="yes" id="yes" >
                                <label for="yes">cash</label>
                                <input type="radio" value="no" id="no" >
                                <label for="no">credit</label>

                            </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Foc Tax</label>
                                <br>


                                <input type="radio" value="yes" id="yes" >
                                <label for="yes">Yes</label>
                                <input type="radio" value="no" id="no" >
                                <label for="no">No</label>

                            </div>
                            <div class="mb-3 col-md-2">
                                <label class="form-label">Invoice Discount</label>
                                <input type="number"  class="form-control"  name="invoicediscount" >
                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status</label>
                                <br>


                                <input type="radio"   value="pending" id="yes" name="pending">
                                <label for="pending">Pending</label>
                                <input type="radio" value="confirmed" id="no" name="confirmed" >
                                <label for="confirmed">Confirmed</label>
                                <input type="radio" value="approved" id="no" name="approved" >
                                <label for="approved">Approved</label>
                                <input type="radio" value="cancelled" id="no" name="cancelled" >
                                <label for="cancelled">Cancelled</label>


                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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
