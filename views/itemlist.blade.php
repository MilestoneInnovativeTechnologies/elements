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
        function addtoCart(id) {
            var qty = document.getElementById("qty"+id).value;
            var focqty = document.getElementById("focqty"+id).value;
            document.getElementById("myQty").value = qty;
            document.getElementById("myFocQty").value = focqty;
            document.getElementById("myId").value = id;
            document.getElementById("myForm").submit();
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

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Items </h4>
                    @include('Elements::message')
                    <div class="card-body">
                        <form id="searchForm" method="GET" action="/searchitems">@csrf
                        <div class="row gx-3 gy-2 align-items-center">
                            <div class="col-md-9">
                                <input type="text"  class="form-control" placeholder="Search..." name="search" aria-describedby="basic-addon-search31">
                            </div>
                            <div class="col-md-3">
                                <button id="showToastPlacement" class="btn btn-primary d-block">Search</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="row mb-5">
                        @forelse($data as $value)
                            <div class="col-md-6 col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $value->displayname }}</h5>
                                        <h6 class="card-subtitle text-muted">Rate: {{ $value->rate }}</h6>
                                        <br>
                                        @php
                                            $id = $value->id;
                                            if(isset(session('cart')[$id])) {
                                                $cart = session('cart');
                                        @endphp
                                        <div class="input-group">
                                            <span class="input-group-text">Qty: &nbsp;<strong> {{ $cart[$id]['quantity'] }}</strong></span>
                                            <span class="input-group-text">Foc Qty: &nbsp; <strong> {{ $cart[$id]['foc_quantity'] }}</strong></span>
                                        </div>
                                        <br>
                                        <h6 class="card-subtitle text-muted"><span class="badge bg-label-warning me-1">Added to Cart</span></h6>
                                        @php
                                            }else{
                                        @endphp
                                        <div class="input-group">
                                            <span class="input-group-text">Qty</span>
                                            <input type="number" aria-label="Qty"  id ="qty{{ $id }}" class="form-control"  min="0" value="1">
                                            <span class="input-group-text">Foc Qty</span>
                                            <input type="number" aria-label="Foc Qty" id ="focqty{{ $id }}" class="form-control"  min="0" value="0">
                                        </div>
                                        <br>
                                        <a href="javascript:void(0)" onclick="addtoCart({{ $id }})" class="btn btn-sm btn-primary">Order</a>
                                        @php

                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-secondary" role="alert"> Product Not Found.</div>
                        @endforelse
                    </div>

                    <div class="row mb-5">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @if(session()->has('cart'))
                    <div class="row mb-5">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            <a href="{{url('ordersummary')}}" class="btn btn-primary btn-lg">Proceed</a>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- / Content -->

                <div style="display:none">
                    <form id="myForm" action="/addtocart">@csrf
                        <input type="text" id="myId" name="myId" />
                        <input type="text" id="myQty" name="myQty" />
                        <input type="text" id="myFocQty" name="myFocQty" />
                    </form>
                </div>

{{--                @dd(session()->all()) ;--}}

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

{{--https://www.educative.io/answers/how-to-implement-search-in-laravel--}}
