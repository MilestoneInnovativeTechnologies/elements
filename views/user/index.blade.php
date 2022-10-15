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
        function deleteuser(obj, link){
            $("#delete-form").attr('action', link);
            $("#deleteModal").modal('show');        }
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
                    <h4 class="fw-bold py-0 mb-0">Users</h4>
                    <div class="row">
                        <div style = "display: flex; justify-content:flex-end;">
                            <a href="{{ route('user.create') }}" class="btn btn-primary"
                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                               data-bs-html="true" title="" data-bs-original-title="<span> New User </span>">
                                <span class="tf-icons bx bx-plus-circle"></span>&nbsp; New User</a>
                        </div>
                    </div>
                    <br>
                    @include('Elements::message')

                    <div class="card">
                        <h5 class="card-header">Record</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @php $i = $data->perPage() * ($data->currentPage() - 1); @endphp
                                @forelse($data as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 'executive')
                                            <span class="badge bg-label-warning me-1">Sales Executive</span>
                                        @elseif($user->role == 'admin')
                                            <span class="badge bg-label-primary me-1">Admin</span>
                                        @else
                                            <span class="badge bg-label-secondary me-1">None</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status == 'active')
                                            <span class="badge bg-label-success me-1">Active</span>
                                        @elseif($user->status == 'inactive')
                                            <span class="badge bg-label-error me-1">InActive</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">None</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('user.show',$user->id) }}"><i class="bx bx-show-alt me-1"></i> View</a>
                                                <a class="dropdown-item" href="{{ route('user.edit',$user->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="#" onclick="deleteuser(this, '{{ route('user.destroy',$user->id) }}');"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr class="table-primary">
                                        <td class ="text-center mt-2" colspan="6">No Records</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="6">{{ $data->links('pagination::bootstrap-4') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- / Content -->


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
                            <form action="#" id="delete-form" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">Are you sure you want to delete?</div>
                                <div class="modal-footer">
                                    {{--                                    <input type="hidden" id="deleteid" name="deleteid">--}}
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
                <!-- / DeleteModal -->
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
