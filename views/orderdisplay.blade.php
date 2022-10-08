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
                            <div class="card mb-4">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0">&nbsp;</h5>
                                                            <small class="text-muted float-end">{{ $data[0]->order_date  }}</small>
                                                        </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Order ID</label>
                                            <label class="col-sm-9">{{ $data[0]->id }}</label>
                                        </div>                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Customer Name</label>
                                            <label class="col-sm-9">{{ $data[0]->rcustomer->display_name }}</label>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Order Date</label>
                                            <label class="col-sm-9">{{ $data[0]->order_date }}</label>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Reference Number</label>
                                            <div class="form-text">{{ $data[0]->reference_number }}</div>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Narration</label>
                                            <div class="form-text">{{ $data[0]->narration }}</div>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Payment Mode</label>
                                            <div class="form-text">
                                                @if ( $data[0]->payment_mode == 'cash')
                                                    Cash
                                                @else
                                                    Credit
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Credit Period</label>
                                            <div class="form-text">{{ $data[0]->credit_period }}</div>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Foc Tax</label>
                                            <div class="form-text">{{ $data[0]->foctax }}</div>
                                        </div>
                                        @dd(1)





                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Foc Tax </label>
                                            <br>
                                            <input type="checkbox" id="foctaxcheck" name="foctaxcheck" onclick="foccheck()"
                                                   {{ (session('foc')) ? 'checked' : '' }}
                                                   style="height:20px; width:20px; vertical-align: middle;">
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                    <h5 class="card-header">Order Details</h5>
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
                                                    if (session('cart')){
                                                        $cart=session('cart');
                                                        $cartcount = count($cart);
                                                        $i = $foctax = $grossamount = $totaltax =
                                                        $totaldiscount = $invoicediscount = $invdiscountamt = $netamt
                                                        = $totalfoctax = 0;

                                                if (session('invoicediscount')){
                                                    $invoicediscount = session('invoicediscount');
                                                    $invdiscountamt = round(($invoicediscount/$cartcount), 3);
                                                }
                                                    foreach ($cart as $key =>$item)
                                                        {
                                                            $name = $item['name'];
                                                            $quantity = $item['quantity'];
                                                            $focquantity = $item['foc_quantity'];
                                                            $rate = $item['rate'];
                                                            $discount = $item['discount'];
                                                            $amount =  $quantity * $rate;
                                                            $grossamount =  $grossamount + $amount;
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
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{$name}}</td>
                                                    <td>{{$quantity}}</td>
                                                    <td>{{$focquantity}}</td>
                                                    <td>{{$rate}}</td>
                                                    <td>{{$discount}}</td>
                                                    <td>{{$amount}}</td>
                                                    <td>{{$taxamount}}</td>
                                                    <td>{{$totalamount}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                {{--                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editModal">--}}
                                                                <a class="dropdown-item" onclick="editPop({{$key}},'{{$name}}', {{$quantity}},{{$focquantity}}, {{$discount}});">
                                                                    <i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                <a class="dropdown-item" onclick="deletePop({{$key}});">
                                                                    <i class="bx bx-trash me-1"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    }
                                                $netamt = $grossamount - $totaldiscount - $invoicediscount;
                                                $finalamt = $netamt + $totaltax;
                                                if (session('foc')){
                                                    $finalamt = $finalamt +$totalfoctax;
                                                    $foctax = $totalfoctax;
                                                }
                                                }
                                                @endphp
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Gross Amount</label>
                                            <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                                   value="{{ round($grossamount, 3) }}" readonly>

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Discount</label>
                                            <input class="form-control" style="text-align: right;" type="number" id = "grossamount" name="total"
                                                   value="{{ round($totaldiscount, 3) }}" readonly>

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Invoice Discount</label>
                                            <small class="text-muted float-end">
                                                <a class="" href="#" onclick="invoicediscountPop()"
                                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                   data-bs-html="true" title=""
                                                   data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Edit</span>">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    {{--                                                <span class="text-primary fw-semibold align-middle">Edit</span>--}}
                                                </a>
                                            </small>
                                            <input type="number" min="0" style="text-align: right;" class="form-control"  name="invoice_discount"
                                                   id="invoicediscount" value="{{ $invoicediscount }}" readonly>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Net Amount</label>
                                            <input class="form-control" style="text-align: right;" type="number" id ="netamt" name="total"
                                                   value="{{ round($netamt, 3) }}" readonly>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label  class="form-label">Vat</label>
                                            <input class="form-control" style="text-align: right;" type="number" id= "vat" name="totaltax"
                                                   value="{{ round($totaltax, 3) }}" readonly>
                                            <br>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Foc Tax</label>
                                            <input type="hidden" id="totalfoctax" value="{{ $totalfoctax }}">
                                            <input class="form-control" style="text-align: right;" type="number" id="foctax" name="foctax"
                                                   value="{{ $foctax }}" readonly>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Net Amount (Inc Tax)</label>
                                            <input class="form-control" style="text-align: right;" type="number" id="finalnetamt" name="netamt"
                                                   value="{{ round($finalamt, 3)  }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-10">
                                            <a href="{{url('index')}}"  class="btn btn-outline-secondary">OK</a>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
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
