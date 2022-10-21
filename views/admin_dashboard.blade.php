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
                    <h4 class="fw-bold py-3 mb-4">Admin Dashboard</h4>
                    <div class="row">
                        <div style = "display: flex; justify-content:flex-end">
                            <a href="{{url('customerlist')}}" class="btn btn-primary"
                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                               data-bs-html="true" title="" data-bs-original-title="<span> New Order </span>">
                                <span class="tf-icons bx bx-plus-circle"></span>&nbsp; New Order</a>
                        </div>
                    </div><br>
                    <div class="card">
                        <h5 class="card-header">Pending Orders</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @php $i = $data->perPage() * ($data->currentPage() - 1); @endphp
                                @forelse($data as $value)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>Ele{{ $value->id }}</td>
                                        <td>{{ date('d-M-Y', strtotime($value->order_date))}}</td>
                                        <td>{{ $value->rcustomer->display_name }}</td>
                                        <td>
                                            @switch($value->status)
                                                @case('Pending')
                                                <span class="badge bg-label-warning me-1">{{ $value->status }}</span>
                                                @break
                                                @case('Confirmed')
                                                <span class="badge bg-label-info me-1">{{ $value->status }}</span>
                                                @break
                                                @case('Approved')
                                                <span class="badge bg-label-success me-1">{{ $value->status }}</span>
                                                @break
                                                @case('Cancelled')
                                               <span class="badge bg-label-danger me-1">{{ $value->status }}</span>
                                               @break
                                               @default
                                               <span class="badge bg-label-primary me-1">{{ $value->status }}</span>
                                            @endswitch

                                        </td>
                                        <td>
                                            {{--                                            <div class="dropdown">--}}
                                            {{--                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">--}}
                                            {{--                                                    <i class="bx bx-dots-vertical-rounded"></i>--}}
                                            {{--                                                </button>--}}
                                            <div class="edit">
                                                <a class="edit" href="{{ route('admin_editorder', ['id' => $value->id]); }}"><i class="bx bx-edit-alt me-1"></i></a>
                                                {{--                                                    @if($value->status == 'Pending')--}}
                                                {{--                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>--}}
                                                {{--                                                        <a class="dropdown-item" href="{{ url('index')}}"><i class="bx bx-trash me-1"></i> Delete</a>--}}
                                                {{--                                                    @endif--}}

                                            </div>

                                            {{--                                            </div>--}}
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
