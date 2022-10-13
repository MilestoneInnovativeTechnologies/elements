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
                    <h4 class="fw-bold py-3 mb-4">User Account</h4>
                    @include('Elements::message')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Details</h5>

                                <!-- Account -->
                                <div class="card-body">
                                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="role" class="form-label">Role</label>
                                                <select name="role" class="select2 form-select">
                                                    <option value="executive">Sales Executive</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6"></div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name" autofocus="" value="{{ old('name') }}">
                                                <span style="color:red">@error('name'){{$message}}@enderror</span>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="lastName" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}">
                                                <span style="color:red">@error('password'){{$message}}@enderror</span>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
                                                <span style="color:red">@error('email'){{$message}}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                            <a class="btn btn-outline-secondary" href="{{ route('user.index') }}"> Cancel</a>
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
