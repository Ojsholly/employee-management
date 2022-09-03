<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route(auth()->user()->getRoleNames()->first().'.dashboard') }}">
            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul @class(['collapsed' => request()->route()->named('super-admin.admins.*'), 'show' => request()->route()->named('super-admin.admins.*'), 'dropdown-nav' => request()->route()->named('super-admin.admins.*')])>
            <li class="nav-item">
                <a href="{{ route(auth()->user()->getRoleNames()->first().'.dashboard') }}">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                  <path
                      d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                  />
                </svg>
              </span>
                    <span class="text">
                Dashboard
              </span>
                </a>
            </li>
            @can('create admin accounts')
                <li class="nav-item nav-item-has-children">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_1"
                        aria-controls="ddmenu_1"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
              <span class="icon">
               <svg
                   width="22"
                   height="22"
                   viewBox="0 0 22 22"
                   fill="none"
                   xmlns="http://www.w3.org/2000/svg"
               >
                  <path
                      d="M11.0001 3.66675C11.9725 3.66675 12.9052 4.05306 13.5928 4.74069C14.2804 5.42832 14.6667 6.36095 14.6667 7.33341C14.6667 8.30587 14.2804 9.23851 13.5928 9.92614C12.9052 10.6138 11.9725 11.0001 11.0001 11.0001C10.0276 11.0001 9.09499 10.6138 8.40736 9.92614C7.71972 9.23851 7.33341 8.30587 7.33341 7.33341C7.33341 6.36095 7.71972 5.42832 8.40736 4.74069C9.09499 4.05306 10.0276 3.66675 11.0001 3.66675ZM11.0001 5.50008C10.5139 5.50008 10.0475 5.69324 9.70372 6.03705C9.3599 6.38087 9.16675 6.84718 9.16675 7.33341C9.16675 7.81964 9.3599 8.28596 9.70372 8.62978C10.0475 8.97359 10.5139 9.16675 11.0001 9.16675C11.4863 9.16675 11.9526 8.97359 12.2964 8.62978C12.6403 8.28596 12.8334 7.81964 12.8334 7.33341C12.8334 6.84718 12.6403 6.38087 12.2964 6.03705C11.9526 5.69324 11.4863 5.50008 11.0001 5.50008ZM11.0001 11.9167C13.4476 11.9167 18.3334 13.1359 18.3334 15.5834V18.3334H3.66675V15.5834C3.66675 13.1359 8.55258 11.9167 11.0001 11.9167ZM11.0001 13.6584C8.27758 13.6584 5.40841 14.9967 5.40841 15.5834V16.5917H16.5917V15.5834C16.5917 14.9967 13.7226 13.6584 11.0001 13.6584Z"
                  />
                </svg>
              </span>
                        <span class="text">Administrators</span>
                    </a>
                    <ul id="ddmenu_1" class="collapse dropdown-nav">
                        <li>
                            <a href="{{ route('super-admin.admins.create') }}">Create Admin</a>
                        </li>
                        @can('retrieve admin accounts')
                            <li>
                                <a href="{{ route('super-admin.admins.index') }}" @class(['active' => request()->route()->named('super-admin.admins.index')])> View Admins </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('create company accounts')
                <li class="nav-item nav-item-has-children">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_2"
                        aria-controls="ddmenu_2"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
              <span class="icon">
                <b>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16"> <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/> </svg>
                </b>
              </span>
                        <span class="text">Companies</span>
                    </a>
                    <ul id="ddmenu_2" class="collapse dropdown-nav">
                        @can('create company accounts')
                            <li>
                                <a href="{{ route(auth()->user()->getRoleNames()->first().".companies.create") }}">Create Company </a>
                            </li>
                        @endcan
                        @can('retrieve admin accounts')
                            <li>
                                <a href="{{ route(auth()->user()->getRoleNames()->first().".companies.index") }}"> View Companies </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->
