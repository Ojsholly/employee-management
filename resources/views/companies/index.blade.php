@extends('layouts.layout')

@section('title', 'Companies')

@section('content')
    <!-- ========== table components start ========== -->
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Companies</h2>
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
                                The list of companies on the system currently.
                            </p>
                            @if($companies->isEmpty())
                                <div class="alert alert-warning">
                                    <p class="mb-0">
                                        No companies found.
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
                                            <th class="lead-email"><h6>Website</h6></th>
                                            <th class="lead-email"><h6>Date Added</h6></th>
                                            <th><h6>Action</h6></th>
                                        </tr>
                                        <!-- end table row-->
                                        </thead>
                                        <tbody>
                                        @foreach($companies as $company)
                                            <tr>
                                                <td class="min-width">
                                                    <p class="text-bold">{{ (($companies->currentPage() - 1) * $companies->perPage()) + $loop->iteration."." }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ Str::ucfirst($company->username) }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $company->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="{{ $company->website }}" target="_blank" rel="noreferrer  nofollow">{{ $company->website }}</a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $company->created_at->toDayDateTimeString() }}</p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        @can('update company account')
                                                            <a href="{{ route(auth()->user()->getRoleNames()->first().".companies.edit", ['company' => $company->uuid]) }}" class="text-warning">
                                                                <i class="lni lni-pencil"></i>
                                                            </a>
                                                        @endcan
                                                        @can('delete company account')
                                                            <button class="text-danger delete" data-id="{{ $company->uuid }}">
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
                                {!! $companies->links() !!}
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

        $("document").ready(function () {
            $('.delete').click(function (e) {
                e.preventDefault()

                let id = $(this).data('id');
                let prefix = "{{ route(auth()->user()->getRoleNames()->first().'.companies.destroy', ':id') }}";
                let url = prefix.replace(':id', id);

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
                                    'Company has been deleted.',
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
                });
            });
        });
    </script>
@endpush
