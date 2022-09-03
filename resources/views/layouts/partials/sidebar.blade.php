<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route(auth()->user()->getRoleNames()->first().'.dashboard') }}">
            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
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
                            <a href="projects.html">Create Admin</a>
                        </li>
                        @can('retrieve admin accounts')
                            <li>
                                <a href="{{ route('super-admin.admins.index') }}"> View Admins </a>
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
                                <a href="projects.html">Create Company </a>
                            </li>
                        @endcan
                        @can('ret    rieve admin accounts')
                            <li>
                                <a href=""> View Companies </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                <a href="kanban.html">
              <span class="icon">
                <svg
                    width="18"
                    height="20"
                    viewBox="0 0 18 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M16.3333 19.1666H1.66667C1.42355 19.1666 1.19039 19.07 1.01849 18.8981C0.846577 18.7262 0.75 18.493 0.75 18.2499V1.74992C0.75 1.5068 0.846577 1.27365 1.01849 1.10174C1.19039 0.929829 1.42355 0.833252 1.66667 0.833252H16.3333C16.5764 0.833252 16.8096 0.929829 16.9815 1.10174C17.1534 1.27365 17.25 1.5068 17.25 1.74992V18.2499C17.25 18.493 17.1534 18.7262 16.9815 18.8981C16.8096 19.07 16.5764 19.1666 16.3333 19.1666ZM15.4167 17.3333V2.66659H2.58333V17.3333H15.4167ZM5.33333 5.41658H12.6667V7.24992H5.33333V5.41658ZM5.33333 9.08325H12.6667V10.9166H5.33333V9.08325ZM5.33333 12.7499H9.91667V14.5833H5.33333V12.7499Z"
                  />
                </svg>
              </span>
                    <span class="text">
                Kanban <span class="pro-badge">Pro</span>
              </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="file-manager.html">
              <span class="icon">
                <svg
                    width="18"
                    height="16"
                    viewBox="0 0 18 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M1.77778 1.77778V14.2222H16V3.55556H8.52089L6.74311 1.77778H1.77778ZM9.25689 1.77778H16.8889C17.1246 1.77778 17.3507 1.87143 17.5174 2.03813C17.6841 2.20483 17.7778 2.43092 17.7778 2.66667V15.1111C17.7778 15.3469 17.6841 15.573 17.5174 15.7397C17.3507 15.9064 17.1246 16 16.8889 16H0.888889C0.653141 16 0.427048 15.9064 0.260349 15.7397C0.0936505 15.573 0 15.3469 0 15.1111V0.888889C0 0.653141 0.0936505 0.427048 0.260349 0.260349C0.427048 0.0936505 0.653141 0 0.888889 0H7.47911L9.25689 1.77778Z"
                  />
                </svg>
              </span>
                    <span class="text">
                File Manager <span class="pro-badge">Pro</span>
              </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.html">
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
                    <span class="text">
                Profile <span class="pro-badge">Pro</span>
              </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="invoice.html">
              <span class="icon">
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M17.4166 7.33333C18.9383 7.33333 20.1666 8.56167 20.1666 10.0833V15.5833H16.4999V19.25H5.49992V15.5833H1.83325V10.0833C1.83325 8.56167 3.06159 7.33333 4.58325 7.33333H5.49992V2.75H16.4999V7.33333H17.4166ZM7.33325 4.58333V7.33333H14.6666V4.58333H7.33325ZM14.6666 17.4167V13.75H7.33325V17.4167H14.6666ZM16.4999 13.75H18.3333V10.0833C18.3333 9.57917 17.9208 9.16667 17.4166 9.16667H4.58325C4.07909 9.16667 3.66659 9.57917 3.66659 10.0833V13.75H5.49992V11.9167H16.4999V13.75ZM17.4166 10.5417C17.4166 11.0458 17.0041 11.4583 16.4999 11.4583C15.9958 11.4583 15.5833 11.0458 15.5833 10.5417C15.5833 10.0375 15.9958 9.625 16.4999 9.625C17.0041 9.625 17.4166 10.0375 17.4166 10.5417Z"
                  />
                </svg>
              </span>
                    <span class="text">Invoice</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="task.html">
              <span class="icon">
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M4.58341 8.70841L6.87508 12.8334H2.29175L4.58341 8.70841ZM2.75008 3.66675H6.41675V7.33341H2.75008V3.66675ZM4.58341 18.3334C5.06964 18.3334 5.53596 18.1403 5.87978 17.7964C6.22359 17.4526 6.41675 16.9863 6.41675 16.5001C6.41675 16.0139 6.22359 15.5475 5.87978 15.2037C5.53596 14.8599 5.06964 14.6667 4.58341 14.6667C4.09718 14.6667 3.63087 14.8599 3.28705 15.2037C2.94324 15.5475 2.75008 16.0139 2.75008 16.5001C2.75008 16.9863 2.94324 17.4526 3.28705 17.7964C3.63087 18.1403 4.09718 18.3334 4.58341 18.3334ZM8.25008 4.58341V6.41675H19.2501V4.58341H8.25008ZM8.25008 17.4167H19.2501V15.5834H8.25008V17.4167ZM8.25008 11.9167H19.2501V10.0834H8.25008V11.9167Z"
                  />
                </svg>
              </span>
                    <span class="text">
                Task <span class="pro-badge">Pro</span>
              </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="calendar.html">
              <span class="icon">
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M8.25 9.16675H6.41667V11.0001H8.25V9.16675ZM11.9167 9.16675H10.0833V11.0001H11.9167V9.16675ZM15.5833 9.16675H13.75V11.0001H15.5833V9.16675ZM17.4167 2.75008H16.5V0.916748H14.6667V2.75008H7.33333V0.916748H5.5V2.75008H4.58333C3.56583 2.75008 2.75 3.57508 2.75 4.58341V17.4167C2.75 17.903 2.94315 18.3693 3.28697 18.7131C3.63079 19.0569 4.0971 19.2501 4.58333 19.2501H17.4167C17.9029 19.2501 18.3692 19.0569 18.713 18.7131C19.0568 18.3693 19.25 17.903 19.25 17.4167V4.58341C19.25 4.09718 19.0568 3.63087 18.713 3.28705C18.3692 2.94324 17.9029 2.75008 17.4167 2.75008ZM17.4167 17.4167H4.58333V7.33342H17.4167V17.4167Z"
                  />
                </svg>
              </span>
                    <span class="text">
                Calendar <span class="pro-badge">Pro</span>
              </span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class=""
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_3"
                    aria-controls="ddmenu_3"
                    aria-expanded="true"
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
                      d="M12.9067 14.2908L15.2808 11.9167H6.41667V10.0833H15.2808L12.9067 7.70917L14.2083 6.41667L18.7917 11L14.2083 15.5833L12.9067 14.2908ZM17.4167 2.75C17.9029 2.75 18.3692 2.94315 18.713 3.28697C19.0568 3.63079 19.25 4.0971 19.25 4.58333V8.86417L17.4167 7.03083V4.58333H4.58333V17.4167H17.4167V14.9692L19.25 13.1358V17.4167C19.25 17.9029 19.0568 18.3692 18.713 18.713C18.3692 19.0568 17.9029 19.25 17.4167 19.25H4.58333C3.56583 19.25 2.75 18.425 2.75 17.4167V4.58333C2.75 3.56583 3.56583 2.75 4.58333 2.75H17.4167Z"
                  />
                </svg>
              </span>
                    <span class="text">Auth</span>
                </a>
                <ul id="ddmenu_3" class="collapsed show dropdown-nav">
                    <li>
                        <a href="signin.html" class="active"> Sign In </a>
                    </li>
                    <li>
                        <a href="signup.html"> Sign Up </a>
                    </li>
                    <li>
                        <a href="reset-password.html">
                  <span class="text">
                    Reset Password <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                </ul>
            </li>
            <span class="divider"><hr /></span>
            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class="collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_4"
                    aria-controls="ddmenu_4"
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
                      d="M3.66675 4.58325V16.4999H19.2501V4.58325H3.66675ZM5.50008 14.6666V6.41659H8.25008V14.6666H5.50008ZM10.0834 14.6666V11.4583H12.8334V14.6666H10.0834ZM17.4167 14.6666H14.6667V11.4583H17.4167V14.6666ZM10.0834 9.62492V6.41659H17.4167V9.62492H10.0834Z"
                  />
                </svg>
              </span>
                    <span class="text">UI Elements </span>
                </a>
                <ul id="ddmenu_4" class="collapse dropdown-nav">
                    <li>
                        <a href="alerts.html"> Alerts </a>
                    </li>
                    <li>
                        <a href="buttons.html"> Buttons </a>
                    </li>
                    <li>
                        <a href="cards.html"> Cards </a>
                    </li>
                    <li>
                        <a href="modals.html">
                  <span class="text">
                    Modals <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                    <li>
                        <a href="tabs.html">
                  <span class="text">
                    Tabs <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                    <li>
                        <a href="typography.html"> Typography </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class="collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_55"
                    aria-controls="ddmenu_55"
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
                      d="M1.83325 19.25V17.4167H18.3333V19.25H1.83325ZM18.3333 7.33333V4.58333H16.4999V7.33333H18.3333ZM18.3333 2.75C18.8195 2.75 19.2858 2.94315 19.6296 3.28697C19.9734 3.63079 20.1666 4.0971 20.1666 4.58333V7.33333C20.1666 7.81956 19.9734 8.28588 19.6296 8.6297C19.2858 8.97351 18.8195 9.16667 18.3333 9.16667H16.4999V11.9167C16.4999 12.8891 16.1136 13.8218 15.426 14.5094C14.7383 15.197 13.8057 15.5833 12.8333 15.5833H7.33325C6.36079 15.5833 5.42816 15.197 4.74053 14.5094C4.05289 13.8218 3.66659 12.8891 3.66659 11.9167V2.75H18.3333ZM14.6666 4.58333H5.49992V11.9167C5.49992 12.4029 5.69307 12.8692 6.03689 13.213C6.38071 13.5568 6.84702 13.75 7.33325 13.75H12.8333C13.3195 13.75 13.7858 13.5568 14.1296 13.213C14.4734 12.8692 14.6666 12.4029 14.6666 11.9167V4.58333Z"
                  />
                </svg>
              </span>
                    <span class="text">Icons</span>
                </a>
                <ul id="ddmenu_55" class="collapse dropdown-nav">
                    <li>
                        <a href="icons.html"> LineIcons </a>
                    </li>
                    <li>
                        <a href="mdi-icons.html"> MDI Icons </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class="collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_5"
                    aria-controls="ddmenu_5"
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
                      d="M13.75 4.58325H16.5L15.125 6.41659L13.75 4.58325ZM4.58333 1.83325H17.4167C18.4342 1.83325 19.25 2.65825 19.25 3.66659V18.3333C19.25 19.3508 18.4342 20.1666 17.4167 20.1666H4.58333C3.575 20.1666 2.75 19.3508 2.75 18.3333V3.66659C2.75 2.65825 3.575 1.83325 4.58333 1.83325ZM4.58333 3.66659V7.33325H17.4167V3.66659H4.58333ZM4.58333 18.3333H17.4167V9.16659H4.58333V18.3333ZM6.41667 10.9999H15.5833V12.8333H6.41667V10.9999ZM6.41667 14.6666H15.5833V16.4999H6.41667V14.6666Z"
                  />
                </svg>
              </span>
                    <span class="text"> Forms </span>
                </a>
                <ul id="ddmenu_5" class="collapse dropdown-nav">
                    <li>
                        <a href="form-elements.html"> Form Elements </a>
                    </li>
                    <li>
                        <a href="form-layout.html">
                  <span class="text">
                    Form Layout <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="tables.html">
              <span class="icon">
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z"
                  />
                </svg>
              </span>
                    <span class="text">Tables</span>
                </a>
            </li>
            <span class="divider"><hr /></span>

            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class="collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_77"
                    aria-controls="ddmenu_77"
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
                      d="M14.6667 6.41667V2.75H12.8333V6.41667H9.16667V2.75H7.33333V6.41667C6.41667 6.41667 5.5 7.33333 5.5 8.25V13.2917L8.70833 16.5V19.25H13.2917V16.5L16.5 13.2917V8.25C16.5 7.33333 15.5833 6.41667 14.6667 6.41667ZM14.6667 12.5308L11.9992 15.2075L11.6142 15.5833H10.3858L10.01 15.2075L7.33333 12.5308V8.3325C7.33333 8.305 7.38833 8.25 7.41583 8.25H14.5933C14.6208 8.25 14.6667 8.305 14.6667 8.3325V12.5308Z"
                  />
                </svg>
              </span>
                    <span class="text"> Form Plugins </span>
                </a>
                <ul id="ddmenu_77" class="collapse dropdown-nav">
                    <li>
                        <a href="form-edit.html">
                  <span class="text">
                    QuillJs <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                    <li>
                        <a href="form-validation.html">
                  <span class="text">
                    Form Validation <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class="collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_7"
                    aria-controls="ddmenu_7"
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
                      d="M11.0001 2.75C6.94841 2.75 3.66675 4.39083 3.66675 6.41667V15.5833C3.66675 17.6092 6.95758 19.25 11.0001 19.25C15.0426 19.25 18.3334 17.6092 18.3334 15.5833V6.41667C18.3334 4.39083 15.0517 2.75 11.0001 2.75ZM16.5001 15.5833C16.5001 16.0417 14.5476 17.4167 11.0001 17.4167C7.45258 17.4167 5.50008 16.0417 5.50008 15.5833V13.5392C6.97591 14.2542 8.91008 14.6667 11.0001 14.6667C13.0901 14.6667 15.0242 14.2542 16.5001 13.5392V15.5833ZM16.5001 11.4125C15.3084 12.2833 13.2184 12.8333 11.0001 12.8333C8.78175 12.8333 6.69175 12.2833 5.50008 11.4125V8.83667C6.84758 9.5975 8.80925 10.0833 11.0001 10.0833C13.1909 10.0833 15.1526 9.5975 16.5001 8.83667V11.4125ZM11.0001 8.25C7.45258 8.25 5.50008 6.875 5.50008 6.41667C5.50008 5.95833 7.45258 4.58333 11.0001 4.58333C14.5476 4.58333 16.5001 5.95833 16.5001 6.41667C16.5001 6.875 14.5476 8.25 11.0001 8.25Z"
                  />
                </svg>
              </span>
                    <span class="text"> Data Tables </span>
                </a>
                <ul id="ddmenu_7" class="collapse dropdown-nav">
                    <li>
                        <a href="basic-table.html">
                  <span class="text">
                    Basic Table <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-responsive.html">
                  <span class="text">
                    Responsive Table <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                    <li>
                        <a href="datatables.html">
                  <span class="text">
                    Data Table <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children">
                <a
                    href="signin.html#0"
                    class="collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#ddmenu_8"
                    aria-controls="ddmenu_8"
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
                      d="M20.1666 19.25H1.83325V2.75H3.66659V17.4167H5.49992V9.16667H9.16659V17.4167H10.9999V5.5H14.6666V17.4167H16.4999V12.8333H20.1666V19.25Z"
                  />
                </svg>
              </span>
                    <span class="text"> Charts </span>
                </a>
                <ul id="ddmenu_8" class="collapse dropdown-nav">
                    <li>
                        <a href="chart-js.html">
                  <span class="text">
                    ChartJs <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                    <li>
                        <a href="apex-chart.html">
                  <span class="text">
                    Apex Chart <span class="pro-badge">Pro</span>
                  </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="notification.html">
              <span class="icon">
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M9.16667 19.25H12.8333C12.8333 20.2584 12.0083 21.0834 11 21.0834C9.99167 21.0834 9.16667 20.2584 9.16667 19.25ZM19.25 17.4167V18.3334H2.75V17.4167L4.58333 15.5834V10.0834C4.58333 7.24171 6.41667 4.76671 9.16667 3.94171V3.66671C9.16667 2.65837 9.99167 1.83337 11 1.83337C12.0083 1.83337 12.8333 2.65837 12.8333 3.66671V3.94171C15.5833 4.76671 17.4167 7.24171 17.4167 10.0834V15.5834L19.25 17.4167ZM15.5833 10.0834C15.5833 7.51671 13.5667 5.50004 11 5.50004C8.43333 5.50004 6.41667 7.51671 6.41667 10.0834V16.5H15.5833V10.0834Z"
                  />
                </svg>
              </span>
                    <span class="text">Notifications</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="promo-box">
        <h3>PlainAdmin Pro</h3>
        <p>Get All Dashboards and 300+ UI Elements</p>
        <a
            href="https://plainadmin.com/pro"
            target="_blank"
            rel="nofollow"
            class="main-btn primary-btn btn-hover"
        >
            Purchase Now
        </a>
    </div>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->
