<body>  
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.svg" alt="" height="40"> <span class="logo-txt" style="font-size: 24px">Evento</span>
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.svg" alt="" height="40"> <span class="logo-txt" style="font-size: 24px">Evento</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    
                </div>

                <div class="d-flex">
                    @if (Session::get('email'))
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset(Session::get('photo')) }}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{Session::get('name')}}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('/')}}/logout" style="color: #b23b3b"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>
                    @else
                    <div class="dropdown d-inline-block">
                   
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <a href="{{url('/')}}/login">Login/Register</a>
                            
                     
                        
                    </div>
                    @endif
                    
        
                </div>
            </div>
        </header>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="/portfoliohome" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">HOME</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#about" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">About us</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="/portfoliohome" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Our work</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="/portfoliohome" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Contact us</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="/portfoliohome" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Get Ticket</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-elements">Elements</span> 
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div>
                                                    <div class="menu-title"></div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-5">
                                                            <div>
                                                                <a href="/additem" class="dropdown-item" data-key="t-alerts">Add Instrument</a>
                                                                <a href="{{url('/addportfolio')}}" class="dropdown-item" data-key="t-buttons">Add Portfolio</a>
                                                                {{-- <a href="edititem" class="dropdown-item" data-key="t-cards">edititem</a> --}}
                                                                <a href="/manageitem" class="dropdown-item" data-key="t-carousel">Manage Instrument</a>
                                                                <a href="/manageportfolio" class="dropdown-item" data-key="t-dropdowns">Manage Portfolio</a>
                                                                <a href="/portfoliohome" class="dropdown-item" data-key="t-grid">Portfolio Home</a>
                                                                <a href="/managecustomer" class="dropdown-item" data-key="t-images">Manage Customer</a>
                                                                <a href="/addcustomer" class="dropdown-item" data-key="t-modals">Add Customer</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div>
                                                                {{-- <a href="customers" class="dropdown-item" data-key="t-grid">All Customer</a> --}}
                                                                <a href="/customerdashboard" class="dropdown-item" data-key="t-grid">Customer Dashboard</a>
                                                                <a href="/adduser" class="dropdown-item" data-key="t-grid">Add User</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div class="col-lg-4">
                                                <div>
                                                    <div class="menu-title"></div>
                                                    <div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            
                </nav>
            </div>
        </div>

       
</body>
    
    
