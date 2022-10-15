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
    <script>
        function editPop(id, name, quantity, focquantity, discount){
            $('#editid').val(id);
            $('#editname').val(name);
            $('#editquantity').val(quantity);
            $('#editfocquantity').val(focquantity);
            $('#editdiscount').val(discount);
            $("#editModal").modal('show');
        }
    </script>
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

                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Order</h4>
                        @include('Elements::message')
                        {{--                        <nav aria-label="breadcrumb">--}}
                        {{--                            <ol class="breadcrumb breadcrumb-style1">--}}
                        {{--                                <li class="breadcrumb-item">--}}
                        {{--                                    <a href="{{url('customerlist')}}">Customer</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="breadcrumb-item">--}}
                        {{--                                    <a href="{{url('itemlist')}}">Item</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="breadcrumb-item active">Order Summary</li>--}}
                        {{--                            </ol>--}}
                        {{--                        </nav>--}}
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    @php $status = $data[0]->status @endphp
                                    @switch($status)
                                        @case('Pending')
                                        <span class="badge bg-label-warning me-1">{{ $status }}</span>
                                        @break
                                        @case('Confirmed')
                                        <span class="badge bg-label-info me-1">{{ $status }}</span>
                                        @break
                                        @case('Approved')
                                        <span class="badge bg-label-success me-1">{{ $status }}</span>
                                        @break
                                        @case('Cancelled')
                                        <span class="badge bg-label-danger me-1">{{ $status }}</span>
                                        @break
                                        @default
                                        <span class="badge bg-label-primary me-1">{{ $status }}</span>
                                    @endswitch
                                </h5>
                                <small class="text-muted float-end">{{ $data[0]->order_date  }}</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        @php
                                            //$myCustomer = session('customer');
                                            //dd($myCustomer);
                                            //$myCustomername = $myCustomer['name']
                                        @endphp
                                        <label class="form-label">Customer Name</label>
                                        <input class="form-control" type="text"  id="customer" name="customer"
                                               value="{{ $data[0]->rcustomer->display_name }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Order ID : </label>
                                        <input type="text" class="form-control" id="reference_number" value="{{ $data[0]->id }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Order Date</label>
                                        <input class="form-control" type="date" name="order_date" value="{{date('Y-m-d', time())}}">
                                        <br>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Reference Number : </label>
                                        <input type="text" class="form-control" id="reference_number" value="{{ $data[0]->reference_number }}" readonly>

                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Payment Mode : </label>
                                        <input type="text" class="form-control" id="reference_number"
                                               value="@if ( $data[0]->payment_mode == 'cash')
                                                Cash
                                            @else
                                                Credit
                                            @endif " >
                                            </span>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Credit Period : </label>
                                        <input type="text" class="form-control" id="reference_number" value="{{ $data[0]->credit_period }}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Foc Tax : </label>
                                        <input type="text" class="form-control" id="reference_number" value="{{ $data[0]->foctax }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Narration : </label>
                                        <input type="text" class="form-control" id="reference_number" value="{{ $data[0]->narration }}" readonly>
                                    </div>
                                </div>
                                <h5 class="card-header">Ordered Item Details</h5>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item name</th>
                                                <th>qty</th>
                                                <th class="text-wrap">Foc QTY</th>
                                                <th class="text-wrap">Gross Rate</th>
                                                <th>Discount</th>
                                                <th class="text-wrap">Taxable Value</th>
                                                <th>Tax</th>
                                                <th class="text-wrap">Total Amount</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $invoicediscount = $data[0]->invoice_discount;
                                                $invdiscountamt = round(($invoicediscount/count($data1)), 3);
                                                $grossamount = $taxamount = $totalfoctax = $totaltax = $totaldiscount =
                                                $totalamount  = $foctax = $netamt = 0;
                                            @endphp
                                            @foreach ($data1 as $key =>$item)
                                                @php

                                                    $name = $item['$name'];
                                                    $quantity = $item['quantity'];
                                                    $focquantity = $item['foc_quantity'];
                                                    $rate = $item['rate'];
                                                    $amount =  $quantity * $rate;
                                                    $grossamount =  $grossamount + $amount;
                                                    $discount = $item['discount'];
                                                    if($discount>0){
                                                        $amount = $amount - $discount;
                                                    }
                                                    if($invdiscountamt >0){
                                                        $amount = $amount - $invdiscountamt;
                                                    }
                                                    $taxamount = $amount * ($item['taxpercent']/100);
                                                    $foc = ($taxamount / $quantity) * $focquantity;
                                                    $totalfoctax = $totalfoctax + $foc;
                                                    $totalamount = $amount + $taxamount;
                                                    $totaltax = $totaltax + $taxamount;
                                                    $totaldiscount = $totaldiscount + $discount;
                                                @endphp
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->ritem->displayname }}</td>
                                                    <td>{{$quantity}}</td>
                                                    <td>{{$focquantity}}</td>
                                                    <td>{{$rate}}</td>
                                                    <td>{{$discount}}</td>
                                                    <td>{{$amount}}</td>
                                                    <td>{{$taxamount}}</td>
                                                    <td>{{$totalamount}}</td>
                                                    <td><a onclick="editPop({{$key}},{{ $item->ritem->displayname }},{{$quantity}},{{$focquantity}}, {{$discount}});"
                                                           data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                           data-bs-html="true" title="" data-bs-original-title="<span> Edit </span>">
                                                            <i class="bx bx-edit-alt me-1 bg-label-primary"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                $netamt = $grossamount - $totaldiscount - $invoicediscount;
                                                $finalamt = $netamt + $totaltax;
                                                if ($data[0]->foctax == 'Yes'){
                                                    $finalamt = $finalamt +$totalfoctax;
                                                    $foctax = $totalfoctax;
                                                }
                                            @endphp
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Gross Amount : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{ round($grossamount, 3) }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Discount : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{ round($totaldiscount, 3) }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Invoice Discount : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{ $data[0]->invoice_discount }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Net Amount : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{ round($netamt, 3) }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label  class="form-label">Vat : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{ round($totaltax, 3) }}" readonly>
                                        <br>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Foc Tax : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{$foctax}}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Net Amount (Inc Tax) : </label>
                                        <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                        value="{{ round($finalamt, 3)  }}" readonly>
                                    </div>

                                    <div class="mb-3 col-md-4">

                                        <label for="role" class="form-label">Status :</label>
                                        <select name="role" class="select2 form-select">
                                            <option value="pending">Pending</option>
                                            <option value="confirmed">Confirmed</option>
                                            <option value="approved">Approved</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>





{{--                                                 @switch($status)--}}
{{--                                                @case('Pending')--}}
{{--                                                <span class="badge bg-label-warning me-1">{{ $status }}</span>--}}
{{--                                                @break--}}
{{--                                                @case('Confirmed')--}}
{{--                                                <span class="badge bg-label-info me-1">{{ $status }}</span>--}}
{{--                                                @break--}}
{{--                                                @case('Approved')--}}
{{--                                                <span class="badge bg-label-success me-1">{{ $status }}</span>--}}
{{--                                                @break--}}
{{--                                                @case('Cancelled')--}}
{{--                                                <span class="badge bg-label-danger me-1">{{ $status }}</span>--}}
{{--                                                @break--}}
{{--                                                @default--}}
{{--                                                <span class="badge bg-label-primary me-1">{{ $status }}</span>--}}
{{--                                            @endswitch--}}



                                <div class="row">
                                    <div class="mb-3 col-md-10">
                                        <a href="{{url('adminindex')}}"  class="btn btn-primary">OK</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">@csrf
                                <div class="modal-body">
                                    <input type="hidden" id="editid" name="editid">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="nameSmall" class="form-label">Name</label>
                                            <input type="text" id="editname" name="editname" class="form-control" placeholder="Enter Name" disabled>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label class="form-label" for="emailSmall">Quantity</label>
                                            <input type="number" min="0"  class="form-control" id="editquantity" name="editquantity" oninput="this.value = Math.abs(this.value)">
                                        </div>
                                        <div class="col mb-0">
                                            <label for="dobSmall" class="form-label">FOC Quantity</label>
                                            <input type="number" min="0"  class="form-control" id="editfocquantity" name="editfocquantity" oninput="this.value = Math.abs(this.value)">
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label class="form-label" for="emailSmall">Discount</label>
                                            <input type="number" min="0"  class="form-control" id="editdiscount" name="editdiscount" step="0.01">
                                        </div>
                                        {{--                                                                        <div class="col mb-0">--}}
                                        {{--                                                                            <label for="dobSmall" class="form-label">FOC Quantity</label>--}}
                                        {{--                                                                            <input id="dobSmall" type="number" class="form-control">--}}
                                        {{--                                                                        </div>--}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel </a>
                                    <button class="btn btn-primary">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
