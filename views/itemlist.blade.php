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

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Items </h4>

                    <div class="row mb-5">
                        @for ($i = 0; $i < 25; $i++)
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Item Name</h5>
                                    <p class="card-text"><a href="{{url('itemlist')}}">ABC111</a></p>
                                    <p class="card-text"><a href="{{url('itemlist')}}">ABC112</a></p>
                                    <p class="card-text"><a href="{{url('itemlist')}}">ABC113</a></p>
                                    <p class="card-text"><a href="{{url('itemlist')}}">ABC114</a></p>
                                  </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="row mb-5">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            <a href="{{url('customerlist')}}" class="btn btn-primary btn-lg">Proceed</a>
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
