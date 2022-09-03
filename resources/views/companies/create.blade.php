@extends('layouts.layout')

@section('title', 'Create Company account')

@section('content')
    <!-- ========== tab components start ========== -->
    <section class="tab-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Create company account.</h2>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <!-- ========== form-layout-wrapper start ========== -->
            <div class="form-layout-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-25">Account Information</h6>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route(auth()->user()->getRoleNames()->first().'.companies.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" value="{{ old('name') }}" name="name" required placeholder="{{ fake()->company." ".fake()->companySuffix }}" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Email</label>
                                            <input type="email" value="{{ old('email') }}" name="email" required placeholder="{{ fake()->companyEmail }}" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Username</label>
                                            <input type="text" name="username" value="{{ old('username') }}" required placeholder="{{ fake()->userName() }}" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Website</label>
                                            <input type="text" name="website" value="{{ old('website') }}" placeholder="{{ fake()->url() }}"/>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div
                                            class="button-group d-flex justify-content-center flex-wrap"
                                        >
                                            <button class="main-btn primary-btn btn-hover m-2" type="submit">
                                                Save
                                            </button>
                                            <button class="main-btn danger-btn-outline m-2" type="reset">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== form-layout-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
    <!-- ========== tab components end ========== -->
@endsection
