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
            var rate = document.getElementById("rate"+id).value;
            var minrate = document.getElementById("minrate"+id).value;
            document.getElementById("myQty").value = qty;
            document.getElementById("myFocQty").value = focqty;
            document.getElementById("myRate").value = rate;
            document.getElementById("myminRate").value = minrate;
            document.getElementById("myId").value = id;
            document.getElementById("myForm").submit();
        }
        function ratecheck(id){
            var minrate = $('#minrate'+id).val()
            var rate = $('#rate'+id).val()
            if (minrate.length == 0){
                minrate =0;
            }
            if(rate < minrate){
                $('#order'+id).hide();
                $('#divid'+id).removeClass('col-6').addClass('col-12');
                $('#rate'+id).addClass('btn-outline-danger');
                $('#minratelabel'+id).show();
                $('#minratevalue'+id).show();
            }else{
                $('#order'+id).show();
                $('#divid'+id).removeClass('col-12').addClass('col-6');
                $('#rate'+id).removeClass('btn-outline-danger');
                $('#minratelabel'+id).hide();
                $('#minratevalue'+id).hide();
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

                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-0 mb-2">Items </h4>
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
                                        <h6 class="card-subtitle text-muted mb-1">Rate: {{ $value->rate }}</h6>
                                        @php
                                            $id = $value->id;
                                            if(isset(session('cart')[$id])) {
                                                $cart = session('cart');
                                        @endphp
                                        <div class="input-group">
                                            <span class="input-group-text">Rate: &nbsp;<strong> {{ $cart[$id]['rate'] }}</strong></span>
                                            <span class="input-group-text">Qty: &nbsp;<strong> {{ $cart[$id]['quantity'] }}</strong></span>
                                            <span class="input-group-text">Foc Qty: &nbsp; <strong> {{ $cart[$id]['foc_quantity'] }}</strong></span>
                                        </div>
                                        <br>
                                        <h6 class="card-subtitle text-muted"><span class="badge bg-label-warning me-1">Added to Cart</span></h6>
                                        @php
                                            }else{
                                        @endphp
                                        <div class="col-12 mb-1">
                                        <div class="input-group">
                                            <span class="input-group-text">Qty</span>
                                            <input type="number" aria-label="Qty"  id ="qty{{ $id }}" class="form-control"  min="1" value="1" oninput="this.value = Math.abs(this.value)">
                                            <span class="input-group-text">Foc Qty</span>
                                            <input type="number" aria-label="Foc Qty" id ="focqty{{ $id }}" class="form-control"  min="0" value="0" oninput="this.value = Math.abs(this.value)">
                                        </div>
                                        </div>
                                        <div class="col-6 mb-1" id="divid{{ $id }}">
                                            <div class="input-group">
                                                <span class="input-group-text">Rate</span>
                                                <input type="hidden" id ="minrate{{ $id }}" value="{{ $value->minimum_rate_allowed }}" >
                                                <input type="number" aria-label="Qty"  id ="rate{{ $id }}" class="form-control"  value="{{ $value->rate }}" min="{{ $value->minimum_rate_allowed }}"
                                                       @if( Auth::user()->role!= 'admin')
                                                           onchange="ratecheck({{ $id }})"
                                                       @endif
                                                >
                                                <span class="input-group-text" id ="minratelabel{{ $id }}" style="display: none">Min Rate</span>
                                                <span class="input-group-text" id ="minratevalue{{ $id }}" style="display: none"> {{ $value->minimum_rate_allowed }}</span>
                                            </div>


                                                {{--                                                <div class="form-floating">--}}
{{--                                                    <input type="number" class="form-control" id="rate" value="{{ $value->rate }}" min="{{ $value->minimum_rate_allowed }}" aria-describedby="floatingInputHelp">--}}
{{--                                                    <label for="rate">Rate</label>--}}
{{--                                                </div>--}}

                                        </div>
                                        <a href="javascript:void(0)" id ="order{{ $id }}" onclick="addtoCart({{ $id }})" class="btn btn-sm btn-primary">Order</a>
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
                        <input type="text" id="myRate" name="myRate" />
                        <input type="text" id="myminRate" name="myminRate" />
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
