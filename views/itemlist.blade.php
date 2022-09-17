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
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                        </div>
                    </div>


                    <div class="row mb-5">
                        @foreach ($data as $key => $value)
                        <div class="col-md-6 col-lg-4"  onclick="addtoCart({{ $value->id }})">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $value->displayname }}</h5>
                                    <p class="card-text">{{ $value->rate }}</p>
                                  </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row mb-5">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            <a href="{{url('ordersummary')}}" class="btn btn-primary btn-lg">Proceed</a>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <div style="display:none">
                    <form id="myForm" action="/addtocart">@csrf
                        <input type="text" id="myId" name="myId" />
                    </form>

                </div>

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
