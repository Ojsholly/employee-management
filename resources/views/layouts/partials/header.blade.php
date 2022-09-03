<!-- ========== header start ========== -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-20">
                        <button
                            id="menu-toggle"
                            class="main-btn primary-btn btn-hover"
                        >
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <!-- profile start -->
                    <div class="profile-box ml-15">
                        <button
                            class="dropdown-toggle bg-transparent border-0"
                            type="button"
                            id="profile"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <div class="profile-info">
                                <div class="info">
                                    <h6>{{ auth()->user()->username }}</h6>
                                    <div class="image">
                                        <img
                                            src="{{ asset('assets/images/profile/profile-image.png') }}"
                                            alt=""
                                        />
                                        <span class="status"></span>
                                    </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                        </button>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="profile"
                        >
                            <li>
                                <a href="signin.html#0">
                                    <i class="lni lni-user"></i> View Profile
                                </a>
                            </li>
                            <li>
                                <a onclick="logout()"> <i class="lni lni-exit"></i> Sign Out </a>
                            </li>
                        </ul>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!-- profile end -->
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    function logout() {
        document.getElementById('logout-form').submit();
    }
</script>
<!-- ========== header end ========== -->
