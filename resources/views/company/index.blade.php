@extends('layouts.layout')

@section('title', $company->name ." Profile")

@section('content')
    <!-- ========== section start ========== -->
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Company Profile</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="clients.html#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="clients.html#0">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Clients
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <div class="row">
                <div class="col-xxl-9 col-lg-8">
                    <div class="client-profile-wrapper mb-30">
                        <div class="client-cover">
                            <img
                                src="{{ asset('assets/images/clients/clients-cover.jpg') }}"
                                alt="cover-image"
                            />
                            <div class="update-image">
                                <input type="file" />
                                <label for=""
                                ><i class="lni lni-camera"></i> Edit Cover Photo
                                </label>
                            </div>
                        </div>
                        <div class="client-profile-photo">
                            <div class="image">
                                <img
                                    src="{{ asset('assets/images/clients/client-profile.png') }}"
                                    alt="profile"
                                />
                                <div class="update-image">
                                    <input type="file" />
                                    <label for=""><i class="lni lni-camera"></i></label>
                                </div>
                            </div>
                            <div class="profile-meta text-center pt-25">
{{--                                <h5 class="text-bold mb-10">{{ $company->name }}</h5>--}}
                                <p class="text-sm">Web & UI/UX Design</p>
                            </div>
                        </div>
                        <div class="client-info">
                            <h5 class="text-bold mb-15">About Us</h5>
                            <p class="text-sm mb-20">
                                Hello there, I am an expert Web & UI/UX Designer. I am a
                                full-time Freelancer and my passion is to satisfy my buyers
                                by giving 100% best quality work. I will Design Landing
                                page, UI/UX Design, web template design E-mail template
                                design Flyer Design, All Print Media Design, etc..
                                <a href="clients.html#0" class="text-medium text-dark">[Read More]</a>
                            </p>

                            <ul class="socials">
                                <li>
                                    <a href="clients.html#0"><i class="lni lni-facebook-filled"></i></a>
                                </li>
                                <li>
                                    <a href="clients.html#0"><i class="lni lni-twitter-filled"></i></a>
                                </li>
                                <li>
                                    <a href="clients.html#0"><i class="lni lni-instagram-filled"></i></a>
                                </li>
                                <li>
                                    <a href="clients.html#0"><i class="lni lni-behance-original"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xxl-3 col-lg-4">
                    <div class="row">
                        <div class="col-sm-6 col-lg-12">
                            <div class="icon-card mb-30">
                                <div class="icon purple">
                                    <i class="lni lni-checkmark"></i>
                                </div>
                                <div class="content">
                                    <h6 class="mb-10">New Order</h6>
                                    <h3 class="text-bold">30</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="icon-card mb-30">
                                <div class="icon success">
                                    <i class="lni lni-checkmark"></i>
                                </div>
                                <div class="content">
                                    <h6 class="mb-10">Completed Orders</h6>
                                    <h3 class="text-bold">2K+</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="icon-card mb-30">
                                <div class="icon primary">
                                    <i class="lni lni-checkmark"></i>
                                </div>
                                <div class="content">
                                    <h6 class="mb-10">Cancelled Order</h6>
                                    <h3 class="text-bold">755</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="icon-card mb-30">
                                <div class="icon orange">
                                    <i class="lni lni-star"></i>
                                </div>
                                <div class="content">
                                    <h6 class="mb-10">Positive Rating</h6>
                                    <h3 class="text-bold">1.2K</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style clients-table-card mb-30">
                        <div
                            class="title d-flex justify-content-between align-items-center"
                        >
                            <h6 class="mb-10">Employees</h6>
                            <div class="more-btn-wrapper">
                                <button
                                    class="more-btn dropdown-toggle"
                                    id="moreAction"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="lni lni-more-alt"></i>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="moreAction"
                                >
                                    <li class="dropdown-item">
                                        <a href="clients.html#0" class="text-gray">Mark as Read</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="clients.html#0" class="text-gray">Reply</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if($employees->isEmpty())
                            <div class="alert alert-warning">
                                <p class="mb-0">
                                    No employees found.
                                </p>
                            </div>
                            @else
                            <div class="table-wrapper table-responsive">
                                <table class="table clients-table">
                                    <thead>
                                    <tr>
                                        <th><h6>#</h6></th>
                                        <th><h6>Name</h6></th>
                                        <th><h6>Email</h6></th>
                                        <th><h6>Phone</h6></th>
                                        <th><h6>Date Added</h6></th>
                                        <th><h6>Action</h6></th>
                                    </tr>
                                    <!-- end table row-->
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)

                                        <tr>
                                            <td class="min-width">
                                                <p class="text-bold">{{ (($employees->currentPage() - 1) * $employees->perPage()) + $loop->iteration."." }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $employee->name }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a></p>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a></p>
                                            </td>
                                            <td>
                                                <p>{{ $employee->created_at->toDayDateTimeString() }}</p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    @can('delete employee account')
                                                        <button class="text-danger delete" data-id="{{ $employee->uuid }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- end table row -->
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                            {!! $employees->links() !!}
                        @endif
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- ========== section end ========== -->
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('.delete').click(function (e) {

                e.preventDefault();

                let id = $(this).data('id');
                 var url = '{{ route('super-admin.companies.employees.destroy', [':company', ':employee']) }}';
                url = url.replace(':employee', id);
                url = url.replace(':company', '{{ $company->uuid }}');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Employee has been deleted.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            },
                            error: function (error) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                )
                            }
                        });
                    }
                })
            })
        })
    </script>
@endpush
