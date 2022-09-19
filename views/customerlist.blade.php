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
        function selectCustomer(id) {
            document.getElementById("customerId").value = id;
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
                    <h4 class="fw-bold py-3 mb-4">Customers </h4>
                    @include('Elements::message')

                    <div class="card-body">
                        <form id="searchForm" method="GET" action="/searchcustomer">@csrf
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
                        <div class="col-md-6 col-lg-4" onclick="selectCustomer({{ $value->id }})">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#">{{ $value->display_name }}</a></h5>
                                  </div>
                            </div>
                        </div>
                        @empty
                            <div class="alert alert-secondary" role="alert"> Customer Not Found.</div>
                        @endforelse
                    </div>
                    <div class="row mb-5">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @if(session()->has('customerId'))
                        <div class="row mt-3">
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                                <a href="{{url('itemlist')}}" class="btn btn-primary btn-lg">Proceed</a>
                            </div>
                        </div>
                    @endif
                    <div style="display:none">
                        <form id="myForm" action="/selectcustomer">@csrf
                            <input type="text" id="customerId" name="customerId" />
                        </form>
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
