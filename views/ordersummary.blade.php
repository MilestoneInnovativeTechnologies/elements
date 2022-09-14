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
                <form action="ordersummary" method="POST">

                <!-- Content -->

                  <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Order Summary </h4>
                      {{ csrf_field() }}

                    <div class="row mb-5">
                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">Document Id</label>
                                <input class="form-control" type="integer" name="id">
                            </div>

                            <br>
                            {{--                                            <span style="color:red">@error('firstname'){{$message}}@enderror</span>--}}
                            <div class="col-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" type="date" name="order_date">
                            </div>

                            <br>
                            <div class=" col-md-2">
                                <label class="form-label">Invoice Discount</label>
                                <input type="number"  class="form-control"  name="invoice_discount" >
                            </div>
                            <span style="color:red">@error('invoice_discount'){{$message}}@enderror</span>

                            <br>
                            <div class=" col-md-2">
                                <label class="form-label">Credit Period</label>
                                <input type="number"  class="form-control"  name="credit_period" >
                            </div>
{{--                            <span style="color:red">@error('credit_period'){{$message}}@enderror</span>--}}
                            <br>
                            {{--                                            <span style="color:red">@error('lastName'){{$message}}@enderror</span>--}}
                            <div class="col-3">
                                <label class="form-label">Sales Executive</label>
                                <input class="form-control" type="text" id="sales_executive" name="sales_executive"  >
                            </div>
                            <span style="color:red">@error('sales_executive'){{$message}}@enderror</span>
                            <br><br>
                            <div class="col-2">
                                <label  class="form-label">Reference Number</label>
                                <input type="number" class="form-control" id="reference_number" name="reference_number" >
                            </div>
                            <span style="color:red">@error('reference_number'){{$message}}@enderror</span>
                            <br>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Payment Mode</label>
                                <br>
                                <input type="radio" value="yes" id="cash" name="payment_mode" >
                                <label for="cash">cash</label>
                                <input type="radio" value="credit" id="credit" name="payment_mode">
                                <label for="credit">credit</label>
                                <br>
                                <br>
                            </div>
                            <span style="color:red">@error('payment_mode'){{$message}}@enderror</span>
                            <br>



                            <div class="mb-3 col-md-6">
                                <label class="form-label">Foc Tax</label>
                                <br>


                                <input type="radio" value="yes" id="yes" name="foctax" >
                                <label for="yes">Yes</label>
                                <input type="radio" value="no" id="no" name="foctax">
                                <label for="no">No</label>

                            </div>
                            <span style="color:red">@error('foctax'){{$message}}@enderror</span>
                            <br>


{{--                            <div class=" col-md-2">--}}
{{--                                <label class="form-label">Invoice Discount</label>--}}
{{--                                <input type="number"  class="form-control"  name="invoicediscount" >--}}
{{--                            </div>--}}


                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status</label>
                                <br>
                                <input type="radio"   value="pending" id="pending"  name="status">
                                <label for="pending">Pending</label>
                                <br>
                                <input type="radio" value="confirmed" id="confirmed" name="status" >
                                <label for="confirmed">Confirmed</label>
                                <br>
                                <input type="radio" value="approved" id="approved" name="status" >
                                <label for="approved">Approved</label>
                                <br>
                                <input type="radio" value="cancelled" id="cancelled" name="status" >
                                <label for="cancelled">Cancelled</label>


                            </div>
                            <span style="color:red">@error('status'){{$message}}@enderror</span>
                        </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Order Details</h5>
                            <table class="table table-striped table-bordered">
                                <thead>

                            <tr>
                                <th>id</th>
                                <th>itemname</th>
                                <th>qty</th>
                                <th>rate</th>
                                <th>tax</th>

                            </tr>
                                <tbody>
{{--                                <tr>--}}
{{--                                    <td> {{$order->id}}</td>--}}
{{--                                    <td> {{$order->itemname}}</td>--}}
{{--                                    <td> {{$order->qty}}</td>--}}
{{--                                    <td> {{$order->rate}}</td>--}}
{{--                                    <td> {{$order->tax}}</td>--}}
{{--                                </tr>--}}
                                </tbody>

                                </thead>
                            </table>
                        </div>
                    </div>
{{--                            <div class ="form-group">--}}
{{--                                <input class="btn btn-success" type="submit">--}}
{{----}}
                    </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success me-2">Confirm</button>
                            <button type="submit" class="btn btn-primary me-1">Cancel</button>
                        </div>
{{--                    <div class="mt-2">--}}
{{--                        <a href="{{url('orderhistory')}}" class="btn btn-success btn-lg ">Submit</a>--}}
{{--                        <a href="{{url('customerdetails')}}" class="btn btn-primary btn-lg">Cancel</a>--}}
{{--                    </div>--}}


                    </div>

{{--                    <div class="row mt-3">--}}
{{--                        <div class="d-grid gap-2 col-lg-6 mx-auto">--}}
{{--                            <button class="btn btn-primary " type="button">Submit</button>--}}
{{--                            <button class="btn btn-primary " type="button">Cancel</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </form>
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