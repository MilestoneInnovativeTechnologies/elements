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
                    <h4 class="fw-bold py-3 mb-4">Account</h4>
                    @include('Elements::message')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Profile Details</h5>

                                <!-- Account -->
                                <div class="card-body">
                                    <form action="/updateprofile" method="POST">@csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name" value="{{ $data[0]->name }}" autofocus="">
                                                @if ($errors->has('name'))
                                                    <span class="text-sm text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
{{--                                            <span style="color:red">@error('firstname'){{$message}}@enderror</span>--}}
                                            <div class="mb-3 col-md-6">
                                                <label for="lastName" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" value="{{ $data[0]->password }}">
                                                <input class="form-control" type="hidden" name="oldpassword" id="oldpassword" value="{{ $data[0]->password }}">
                                                @if ($errors->has('password'))
                                                    <span class="text-sm text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Account -->
                            </div>

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
