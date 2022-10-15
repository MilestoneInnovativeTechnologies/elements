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
        function foccheck(){
            var totfoc = parseFloat($('#totalfoctax').val());
            var netamt = parseFloat($('#netamt').val());
            var vat = parseFloat($('#vat').val());
            if($('#foctaxcheck').prop("checked") == true){
                var finalnetamt = (netamt + vat + totfoc).toFixed(3);
                var roundtotfoc = totfoc.toFixed(3);
                $("#foctax").val(roundtotfoc);
                var val = 1;
            }else{
                var finalnetamt = (netamt + vat).toFixed(3);
                $("#foctax").val(0);
                var val = 0;
            }
            $.ajax({
                type:'POST',
                url:'/foc',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { val },
                success:function(data){
                    $("#shortmsg").html(data.msg);
                    $("#msg").show();
                }
            });
            $("#finalnetamt").val(finalnetamt);
        }
        function referencenumber(){
            var val = $('#reference_number').val()
            $.ajax({
                type:'POST',
                url:'/referencenumber',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { val },
                success:function(data){
                }
            });
        }
        function creditperiod(){
            var val = $('#credit_period').val()
            $.ajax({
                type:'POST',
                url:'/creditperiod',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { val },
                success:function(data){
                }
            });
        }
        function editPop(id, name, quantity, focquantity, discount){
            $('#editid').val(id);
            $('#editname').val(name);
            $('#editquantity').val(quantity);
            $('#editfocquantity').val(focquantity);
            $('#editdiscount').val(discount);
            $("#editModal").modal('show');
        }
        function deletePop(id){
            $("#deleteid").val(id);
            $("#deleteModal").modal('show');
        }
        function appplydiscount(){
            var discount = $('#invoicediscount').val();
            var grossamount = $('#grossamount').val();
            var netamt = parseFloat(grossamount) - parseFloat(discount);
            $("#netamt").val(netamt);
            var totfoc = parseFloat($('#totalfoctax').val());
            var vat = parseFloat($('#vat').val());
            var finalnetamt = (netamt + vat + totfoc).toFixed(3);
            $("#finalnetamt").val(finalnetamt);
        }
        function invoicediscountPop(){
            $("#invoiceModal").modal('show');
        }

    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <h4 class="fw-bold py-0 mb-3">Order Summary</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1">
                                <li class="breadcrumb-item">
                                    <a href="{{url('customerlist')}}">Customer</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{url('itemlist')}}">Item</a>
                                </li>
                                <li class="breadcrumb-item active">Order Summary</li>
                            </ol>
                        </nav>
                        @include('Elements::message')
                        <div class="card mb-4">
{{--                            <div class="card-header d-flex justify-content-between align-items-center">--}}
{{--                                <h5 class="mb-0">Basic Layout</h5>--}}
{{--                                <small class="text-muted float-end">Default label</small>--}}
{{--                            </div>--}}
                            <form action="saveorder" method="POST">@csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        @php
                                            //$myCustomer = session('customer');
                                            //$myCustomername = $myCustomer['name']
                                        @endphp
                                        <label class="form-label">Customer Name</label>
                                        <input class="form-control" type="text"  id="customer" name="customer"
                                               value="" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Order Date</label>
                                        <input class="form-control" type="date" name="order_date" value="{{date('Y-m-d', time())}}">
                                        <br>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label  class="form-label">Reference Number</label>
                                        <input type="text" class="form-control" id="reference_number"
                                               name="reference_number" onchange="referencenumber()"
                                        value="{{ (session('referencenumber')) ? session('referencenumber') : '' }}">
                                        <br>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Payment Mode</label>
                                        <br>
                                        <input type="radio" value="cash" id="cash" name="payment_mode" style="height:20px; width:20px; vertical-align: middle;">
                                        <label for="cash">Cash</label>
                                        <input type="radio" value="credit" id="credit" name="payment_mode" checked  style="height:20px; width:20px; vertical-align: middle;">
                                        <label for="credit">Credit</label>
                                        <br>
                                        <span style="color:red">@error('payment_mode'){{$message}}@enderror</span>
                                    </div>
                                    <div class=" col-md-4">
                                        <label class="form-label">Credit Period</label>
                                        <input type="number"  min ="0" class="form-control" name="credit_period"
                                               id="credit_period" onchange="creditperiod()"
                                               value="{{ (session('creditperiod')) ? session('creditperiod') : 0 }}" >
                                        <span style="color:red">@error('credit_period'){{$message}}@enderror</span>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Foc Tax </label>
                                        <br>
                                        <input type="checkbox" id="foctaxcheck" name="foctaxcheck" onclick="foccheck()"
                                               {{ (session('foc')) ? 'checked' : '' }}
                                               style="height:20px; width:20px; vertical-align: middle;">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Narration</label>
                                        <input class="form-control" type="textarea"  id="narration" name="narration">
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
                                                $cartcount = $i = $foctax = $grossamount = $totaltax =
                                                $totaldiscount = $invoicediscount = $invdiscountamt = $netamt =
                                                $totalfoctax = $finalamt = 0;
                                                if (session('cart')){
                                                    $cart=session('cart');
                                                    $cartcount = count($cart);


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
                                                <td><a onclick="editPop({{$key}},'{{$name}}', {{$quantity}},{{$focquantity}}, {{$discount}});"
                                                       data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                       data-bs-html="true" title="" data-bs-original-title="<span> Edit </span>">
                                                        <i class="bx bx-edit-alt me-1 bg-label-primary"></i></a>
                                                    <a onclick="deletePop({{$key}});"
                                                       data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                       data-bs-html="true" title="" data-bs-original-title="<span> Delete </span>">
                                                        <i class="bx bx-trash me-1 bg-label-danger"></i></a>
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
                                        @if($cartcount >0)
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                        @endif
                                        <a href="{{url('clear')}}"  class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/updateitem" method="POST">@csrf
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
                <!-- EditModal ends -->
                <!--Delete Modal -->
                <div class="modal fade"
                     id="deleteModal"
                     aria-labelledby="modalToggleLabel"
                     tabindex="-1"
                     style="display: none"
                     aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalToggleLabel">
                                    Delete<box-icon name='question-mark'></box-icon></h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/deleteitem" method="POST">@csrf
                                <div class="modal-body">Are you sure you want to delete?</div>
                                <div class="modal-footer">
                                    <input type="hidden" id="deleteid" name="deleteid">
                                    <a href=""  class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel </a>
                                    <button class="btn btn-danger">
                                        OK
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--DeleteModal ends-->
                <!-- Invoice Discount Modal -->
                <div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Invoice Discount</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/invoicediscount" method="POST">@csrf
                                <div class="modal-body">
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label class="form-label" for="emailSmall">Discount</label>
                                            <input type="number" min="0"  class="form-control" id="invoicediscount" name="invoicediscount"
                                                   value="{{$invoicediscount}}"
                                                   step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel </a>
                                    <button class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Invoice Discount ends -->
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
