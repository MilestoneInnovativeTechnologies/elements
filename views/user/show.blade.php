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
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="role" class="form-label">Role : </label>
                                                <span class="mb-0">
                                                    @if($user->role == 'executive')
                                                    Sales Executive
                                                    @elseif($user->role == 'admin')
                                                    Admin
                                                    @else
                                                    None
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name : </label>
                                                <span class="mb-0">{{  $user->name }}</span>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="password" class="form-label">Password : </label>
                                                <span class="mb-0">******</span>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Email : </label>
                                                <span class="mb-0">{{  $user->email }}</span>
                                            </div>
                                            <div class="mt-2">
                                                <a class="btn btn-outline-primary" href="{{ route('user.index') }}"> Back</a>
                                            </div>
                                        </div>

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
