@extends('layouts.layout')

@section('title', 'Administrators')

@section('content')
    <!-- ========== table components start ========== -->
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Administrators</h2>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Data Table</h6>
                            <p class="text-sm mb-20">
                                The list of administrators on the system currently.
                            </p>
                            @if($admins->isEmpty())
                                <div class="alert alert-warning">
                                    <p class="mb-0">
                                        No administrators found.
                                    </p>
                                </div>
                                @else
                                <div class="table-wrapper table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="lead-email"><h6>S/N</h6></th>
                                            <th class="lead-email"><h6>Username</h6></th>
                                            <th class="lead-email"><h6>Name</h6></th>
                                            <th class="lead-email"><h6>Email</h6></th>
                                            <th class="lead-email"><h6>Date Added</h6></th>
                                            <th><h6>Action</h6></th>
                                        </tr>
                                        <!-- end table row-->
                                        </thead>
                                        <tbody>
                                        @foreach($admins as $admin)
                                            <tr>
                                                <td class="min-width">
                                                    <p class="text-bold">{{ $loop->iteration."." }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ Str::ucfirst($admin->username) }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $admin->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $admin->created_at->toDayDateTimeString() }}</p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <button class="text-danger delete" data-id="{{ $admin->uuid }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- end table row -->
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                </div>
                                {!! $admins->links() !!}
                            @endif
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
    <!-- ========== table components end ========== -->
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('document').ready(function () {
            $('.delete').click(function (e) {
                e.preventDefault();

                let id = $(this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this administrator!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '/super-admin/admins/' + id,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    Swal.fire(response.message, {
                                        icon: "success",
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function (error) {
                                    Swal.fire(error.responseJSON.message, {
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endpush
