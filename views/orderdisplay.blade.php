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
                        <h4 class="fw-bold py-0 mb-2">Order</h4>
                        @include('Elements::message')
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
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Customer Name : </label>
                                            <span class="mb-0">{{ $data[0]->rcustomer->display_name }}</span>
                                        </div>
                                        @if(Auth::user()->role== 'admin')
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Sales Executive : </label>
                                            <span class="mb-0">{{ $data[0]->rsalesexecutive->name }}</span>
                                        </div>
                                        @endif
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Order ID : </label>
                                            <span class="mb-0">{{ $data[0]->id }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Order Date : </label>
                                            <span class="mb-0">{{ $data[0]->order_date }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Reference Number : </label>
                                            <span class="mb-0">{{ $data[0]->reference_number }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Payment Mode : </label>
                                            <span class="mb-0">
                                                @if ( $data[0]->payment_mode == 'cash')
                                                    Cash
                                                @else
                                                    Credit
                                                @endif
                                            </span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Credit Period : </label>
                                            <span class="mb-0">{{ $data[0]->credit_period }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Foc Tax : </label>
                                            <span class="mb-0">{{ $data[0]->foctax }}</span>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Narration : </label>
                                            <span class="mb-0">{{ $data[0]->narration }}</span>
                                        </div>
                                   </div>
                                    <h5 class="card-header">Ordered Items</h5>
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
                                                        } echo $item['taxpercent'];
                                                        $taxamount = $amount * ($item['tax_percentage']/100);
                                                        $foc = ($taxamount / $quantity) * $focquantity;
                                                        $totalfoctax = $totalfoctax + $foc;
                                                        $totalamount = $amount + $taxamount;
                                                        $totaltax = $totaltax + $taxamount;
                                                        $totaldiscount = $totaldiscount + $discount;
                                                    @endphp
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->ritem->displayname }}</td>
                                                    <td>{{ twodigits($quantity)}}</td>
                                                    <td>{{ twodigits($focquantity)}}</td>
                                                    <td class="text-end">{{ threedigits($rate) }}</td>
                                                    <td class="text-end">{{ threedigits($discount) }}</td>
                                                    <td class="text-end">{{ threedigits($amount) }}</td>
                                                    <td class="text-end">{{ threedigits($taxamount) }}</td>
                                                    <td class="text-end">{{ threedigits($totalamount) }}</td>
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
                                            <span class="mb-0">{{ threedigits($grossamount) }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Discount : </label>
                                            <span class="mb-0">{{ threedigits($totaldiscount) }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Invoice Discount : </label>
                                            <span class="mb-0">{{ threedigits($data[0]->invoice_discount) }}</span>
                                         </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Net Amount : </label>
                                            <span class="mb-0">{{ threedigits($netamt) }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label  class="form-label">Vat : </label>
                                            <span class="mb-0">{{ threedigits($totaltax) }}</span>
                                            <br>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Foc Tax : </label>
                                            <span class="mb-0">{{ threedigits($foctax) }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Net Amount (Inc Tax) : </label>
                                            <span class="mb-0">{{ threedigits($finalamt)  }}</span>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Status : </label>
                                            <span class="mb-0">
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
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-10">
                                            <a href="{{( Auth::user()->role== 'admin')?url('adminindex'): url('index')}}" class="btn btn-primary">OK</a>
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
