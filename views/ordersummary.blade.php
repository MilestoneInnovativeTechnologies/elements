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
        function deletePop(id){
            $("#deleteid").val(id);
            $("#deleteModal").modal('show');
        }
        function foccheck(){
            if($('#foctax').prop("checked") == true){
                alert("Checkbox is checked.");
            }
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
                <form action="/ordersummary" method="POST">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Order Summary </h4>
                            <!-- Basic Breadcrumb -->
                            <!-- Custom style1 Breadcrumb -->
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
                            <!--/ Custom style1 Breadcrumb -->

                        {{ csrf_field() }}
{{--                        @php $netamt=0;@endphp--}}

                        <div class="row mb-5">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">order Id</label>
                                    <input class="form-control" type="number" name="id">

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Customer Name</label>
                                    <input class="form-control" type="text"  id="customer" name="customer" value="{{ session('customername') }}">
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
                                    <input type="checkbox" id="foctax" name="foctax" onclick="foccheck()"  style="height:20px; width:20px; vertical-align: middle;">

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
                                        <th>Foc QTY</th>
                                        <th>Gross Rate</th>
                                        <th>Discount</th>
                                        <th>Taxable Value</th>
                                        <th>Tax</th>
                                        <th>Total Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                    @php
                                            if (session('cart')){
                                                $cart=(session('cart'));
                                                $grossamount = $totaltax= $invoicediscount =$netamt =0;
                                                $foctax=0;
                                                $i=0;
                                            foreach ($cart as $key =>$item)
                                                {
                                                    $name = $item['name'];
                                                    $quantity = $item['quantity'];
                                                    $focquantity = $item['foc_quantity'];
                                                    $rate = $item['rate'];
                                                    $discount = $item['discount'];
                                                    $amount = $quantity * $rate;
                                                    $taxtamount = $amount * ($item['taxpercent']/100);
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
                                        $grossamount = $grossamount +$totalamount;
                                        $netamt = $grossamount - $invoicediscount;
                                                }
                                            }
                                    @endphp

                                            </tbody>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3 col-md-3 " style="margin-left: 700px;">
                                <label class="form-label">Gross Amount</label>
                                <input class="form-control" style="text-align: right;" type="number" name="total" value="{{ $grossamount }}" >


                            <label class="form-label">Discount</label>
                            <input type="number"  style="text-align: right;" class="form-control"  name="invoice_discount" value="{{ $invoicediscount }}" >
                                <label class="form-label">Net Amount</label>
                                <input class="form-control" style="text-align: right;" type="number" name="total" value="0" >
                                <label class="form-label">Vat</label>
                                <input class="form-control" style="text-align: right;" type="number" name="totaltax" value="{{ $totaltax }}" >
                                <label class="form-label">Foc Tax</label>
                                <input class="form-control" style="text-align: right;" type="number" name="foctax" value="{{ $foctax }}">
                                <label class="form-label">Net Amount (Inc Tax)</label>
                                <input class="form-control" style="text-align: right;" type="number" name="netamt" value="{{ $netamt }}" >


                            <br>
                            <br>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                                <a href="{{url('saveorder')}}"  class="btn btn-outline-secondary">Cancel</a>

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

