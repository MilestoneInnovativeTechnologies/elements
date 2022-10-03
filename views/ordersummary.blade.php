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
            if($('#foctacheck').prop("checked") == true){
                var totfoc = parseFloat($('#totalfoctax').val());
                var roundtotfoc = totfoc.toFixed(3);
                var netamt = parseFloat($('#netamt').val());
                var vat = parseFloat($('#vat').val());
                var finalnetamt = (netamt + vat + totfoc).toFixed(3);
                $("#foctax").val(roundtotfoc);
                $("#finalnetamt").val(finalnetamt);
            }
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
                        <h4 class="fw-bold py-3 mb-4">Order Summary</h4>
                        @include('Elements::message')
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
                        <div class="card mb-4">
{{--                            <div class="card-header d-flex justify-content-between align-items-center">--}}
{{--                                <h5 class="mb-0">Basic Layout</h5>--}}
{{--                                <small class="text-muted float-end">Default label</small>--}}
{{--                            </div>--}}
                            <form action="saveorder" method="POST">@csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">order Id</label>
                                        <input class="form-control" type="number" name="id" readonly>

                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Customer Name</label>
                                        <input class="form-control" type="text"  id="customer" name="customer"
                                               value="{{ session('customername') }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Order Date</label>
                                        <input class="form-control" type="date" name="order_date" value="{{date('Y-m-d', time())}}">
                                        <br>
                                    </div>
                                    {{--                                <div class="mb-3 col-md-4">--}}
                                    {{--                                     <label class="form-label">Sales Executive</label>--}}
                                    {{--                                     <input class="form-control" type="text" id="sales_executive" name="sales_executive"  >--}}
                                    {{--                                     <span style="color:red">@error('sales_executive'){{$message}}@enderror</span>--}}
                                    {{--                                </div>--}}
                                    <div class="mb-3 col-md-4">
                                        <label  class="form-label">Reference Number</label>
                                        <input type="text" class="form-control" id="reference_number" name="reference_number" >
                                        <span style="color:red">@error('reference_number'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Narration</label>
                                        <input class="form-control" type="textarea"  id="narration" name="narration">
                                    </div>
                                    <div class=" col-md-4">
                                        <label class="form-label">Credit Period</label>
                                        <input type="text"  class="form-control"  name="credit_period" >
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
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Foc Tax </label>
                                        <br>
                                        <input type="checkbox" id="foctacheck" name="foctacheck" onclick="foccheck()"  style="height:20px; width:20px; vertical-align: middle;">

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
                                                <th>Itemname</th>
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
                                                    $cart=(session('cart'));
                                                    $i= $foctax = $grossamount = $totaltax = $invoicediscount = $netamt
                                                    = $totalfoctax = 0;
                                                foreach ($cart as $key =>$item)
                                                    {
                                                        $name = $item['name'];
                                                        $quantity = $item['quantity'];
                                                        $focquantity = $item['foc_quantity'];
                                                        $rate = $item['rate'];
                                                        $discount = $item['discount'];
                                                        $amount = $quantity * $rate;
                                                        $grossamount =  $grossamount + $amount;

                                                        $taxtamount = $amount * ($item['taxpercent']/100);

                                                        $foc = ($taxtamount / $quantity) * $focquantity;
                                                        $totalfoctax = $totalfoctax + $foc;

                                                        $totalamount = $amount + $taxtamount;
                                                        $totaltax = $totaltax + $taxtamount;
                                            @endphp

                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{$name}}</td>
                                                <td>{{$quantity}}</td>
                                                <td>{{$focquantity}}</td>
                                                <td>{{$rate}}</td>
                                                <td>{{$discount}}</td>
                                                <td>{{$amount}}</td>
                                                <td>{{$taxtamount}}</td>
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
                                            $netamt = $grossamount - $invoicediscount;
                                            $finalamt = $netamt + $totaltax;
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
                                        <small class="text-muted float-end">
                                            <a class="" href="#" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Edit</span>"><i class="bx bx-edit-alt me-1"></i>
{{--                                                <span class="text-primary fw-semibold align-middle">Edit</span>--}}
                                            </a>
                                        </small>
                                        <input type="number" min="0" style="text-align: right;" class="form-control"  name="invoice_discount"
                                               id="invoicediscount" value="{{ $invoicediscount }}" onchange="appplydiscount()" readonly>
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
                                    <div class=" col-md-4">
                                        <label class="form-label">Net Amount (Inc Tax)</label>
                                        <input class="form-control" style="text-align: right;" type="number" id="finalnetamt" name="netamt"
                                               value="{{ round($finalamt, 3)  }}" readonly>
                                    </div>
                                    <div class=" col-md-4">
                                        <button type="submit" class="btn btn-primary">Confirm</button>
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
                                            <input type="number" min="0"  class="form-control" id="editdiscount" name="editdiscount" oninput="this.value = Math.abs(this.value)">
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
