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
                <form action="/ordersummary" method="POST">

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Order Summary </h4>
                        {{ csrf_field() }}
{{--                        @php $netamt=0;@endphp--}}

                        <div class="row mb-5">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">order Id</label>
                                    <input class="form-control" type="integer" name="id">

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Customer id</label>
                                    <input class="form-control" type="text"  id="customer" name="customer" >
                                </div>
                                <div class="mb-3 col-md-4">
                                     <label class="form-label">Order Date</label>
                                     <input class="form-control" type="date" name="order_date">
                                     <br>
                                </div>
                                <div class="mb-3 col-md-4">
                                     <label class="form-label">Sales Executive</label>
                                     <input class="form-control" type="text" id="sales_executive" name="sales_executive"  >
                                     <span style="color:red">@error('sales_executive'){{$message}}@enderror</span>
                                </div>
                                <div class="mb-3 col-md-4">
                                     <label  class="form-label">Reference Number</label>
                                     <input type="integer" class="form-control" id="reference_number" name="reference_number" >
                                     <span style="color:red">@error('reference_number'){{$message}}@enderror</span>
                                     <br>
                                </div>
                                <div class="mb-3 col-md-4">
                                     <label class="form-label">Payment Mode</label>
                                     <br>
                                     <input type="radio" value="yes" id="cash" name="payment_mode" >
                                     <label for="cash">cash</label>
                                     <input type="radio" value="credit" id="credit" name="payment_mode" checked>
                                     <label for="credit">credit</label>
                                     <br>
                                     <span style="color:red">@error('payment_mode'){{$message}}@enderror</span>

                                </div>
                                <div class=" col-md-4">

                                    <label class="form-label">Credit Period</label>
                                    <input type="integer"  class="form-control"  name="credit_period" >
                                </div>
                                <br>

                                <div class="col-md-6">
                                     <label class="form-label">Foc Tax </label>
                                     <input type="checkbox" value="no" id="no" name="foctax" >

                                     <br>
{{--                                    <span style="color:red">@error('foctax'){{$message}}@enderror</span>--}}
                                </div>





{{--                                    <label class="form-label">Status</label>--}}
{{--                                    <br>--}}
{{--                                    <input type="radio"   value="pending" id="pending"  name="status">--}}
{{--                                    <label for="pending">Pending</label>--}}
{{--                                    <br>--}}
{{--                                    <input type="radio" value="confirmed" id="confirmed" name="status" >--}}
{{--                                    <label for="confirmed">Confirmed</label>--}}
{{--                                    <br>--}}
{{--                                    <input type="radio" value="approved" id="approved" name="status" >--}}
{{--                                    <label for="approved">Approved</label>--}}
{{--                                    <br>--}}
{{--                                    <input type="radio" value="cancelled" id="cancelled" name="status" >--}}
{{--                                    <label for="cancelled">Cancelled</label>--}}
{{--                                    <br>--}}
{{--                                    <span style="color:red">@error('status'){{$message}}@enderror</span>--}}

                                <br>
                                <br>
                                <br>
                                <br>

                            <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Order Details</h5>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tbody>

                                    <tr>
                                        <th>#</th>
                                        <th>itemname</th>
                                        <th>qty</th>
                                        <th>rate</th>
                                        <th>Gross Rate</th>
                                        <th>Tax</th>
                                        <th>Total Amount</th>
                                    </tr>
                                    @php
                                        if (session('cart')){
                                            $cart=(session('cart'));
                                            $grossamount = $totaltax= $invoicediscount =$netamt =0;
                                            $foctax=0;
                                            $i=0;
                                        foreach ($cart as $item)
                                            {
                                                $amount =$item['quantity'] * $item['rate'];
                                                $taxtamount = $amount * ($item['taxpercent']/100);
                                                $totalamount = $amount + $taxtamount;
                                                $totaltax = $totaltax +$taxtamount;
                                    @endphp

                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <th>{{$item['name']}}</th>
                                                <th>{{$item['quantity']}}</th>
                                                <th>{{$item['rate']}}</th>
                                                <th>{{$amount}}</th>
                                                <th>{{$taxtamount}}</th>
                                                <th>{{$totalamount}}</th>
                                    @php
                                        $grossamount = $grossamount +$totalamount;
                                        $netamt = $grossamount - $invoicediscount;
                                                }

                                            }
                                    @endphp





{{--                                            @php--}}
{{--                                            {--}}
{{--                                            }--}}
{{--                                            @endphp--}}




{{--                                            <tbody>--}}
{{--                                            @if(session('cart'))--}}

{{--                                                {{(session('cart'))}}--}}
{{--                                                @foreach($order as $cart)--}}
{{--                                                    --}}
{{--                                                                            <tr>--}}

{{--                                                                                <td> {{$cart->id}}</td>--}}
{{--                                                                                <td> {{$cart->itemname}}</td>--}}
{{--                                                                                <td> {{$cart->qty}}</td>--}}
{{--                                                                                <td> {{$cart->rate}}</td>--}}
{{--                                                                                <td> {{$cart->tax}}</td>--}}
{{--                                                                            </tr>--}}
{{--                                            @endif--}}

{{--                                            </tbody>--}}

                                            </tbody>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                                {{--                            <div class ="form-group">--}}
                                {{--                                <input class="btn btn-success" type="submit">--}}
                                {{----}}
                            </div>
                            <div class="mb-3 col-md-3 " style="margin-left: 700px;">
                                <label class="form-label">Gross Amount</label>
                                <input class="form-control" style="text-align: right;" type="number" name="total" value="{{ $grossamount }}" >


                            <label class="form-label">Invoice Discount -</label>
                            <input type="number"  style="text-align: right;" class="form-control"  name="invoice_discount" value="{{ $invoicediscount }}" >
{{--                            <span style="color:red">@error('invoice_discount'){{$message}}@enderror</span>--}}

                                <label class="form-label">Total Tax -</label>
                                <input class="form-control" style="text-align: right;" type="number" name="totaltax" value="{{ $totaltax }}" >
                                <label class="form-label">Foc Tax -</label>
                                <input class="form-control" style="text-align: right;" type="number" name="foctax" value="{{ $foctax }}">
                                <label class="form-label">Net Amt -</label>
                                <input class="form-control" style="text-align: right;" type="number" name="netamt" value="{{ $netamt }}" >


                            <br>
                            <br>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-success me-2">Confirm</button>
                                <button type="reset" class="btn btn-primary me-1">Cancel</button>
                            </div>
                            {{--                    <div class="mt-2">--}}
                            {{--                        <a href="{{url('orderhistory')}}" class="btn btn-success btn-lg ">Submit</a>--}}
                            {{--                        <a href="{{url('customerdetails')}}" class="btn btn-primary btn-lg">Cancel</a>--}}
                            {{--                    </div>--}}


                        </div>
{{--                        @php $netamt=$total+$invoice_discount+ $totaltax+$foctax;@endphp--}}

                    </div>

                    {{--                    <div class="row mt-3">--}}
                    {{--                        <div class="d-grid gap-2 col-lg-6 mx-auto">--}}
                    {{--                            <button class="btn btn-primary " type="button">Submit</button>--}}
                    {{--                            <button class="btn btn-primary " type="button">Cancel</button>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                </form>
{{--                @php $total+=$item['rate']*$item['quantity']; @endphp--}}
{{--                @dd(session()->all())--}}


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
