
<body>  
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{url('/')}}/home" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="{{url('/')}}/assets/images/logo-sm.svg" alt="" height="40"> <span class="logo-txt" style="font-size: 24px">Evento</span>
                            </span>
                        </a>

                        <a href="{{url('/')}}/home" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{url('/')}}/assets/images/logo-sm.svg" alt="" height="40"> <span class="logo-txt" style="font-size: 24px">Evento</span>
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
                            @if (@$home == "home")
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="updateNotificationClickTime()">
                            <i class="fa-solid fa-bell"></i>
                            @if (@$unreadCount > 0)
                            <span class="badge bg-danger rounded-pill" id="notificationCount">{{@$unreadCount }}</span> <!-- Show unread count -->
                            @endif
                            
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown" style="overflow: scroll">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">Notifications</h6>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                @foreach (@$notifications as $notification)
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            {{-- <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-sm" alt="user-pic"> --}}
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $notification->remark }}</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">{{ $notification->remark }}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notification->created_at->diffForHumans() }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                            @endif

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
                            <a class="dropdown-item" href="{{url('/')}}/mytickets"><i class="fa-solid fa-ticket"></i> My Tickets</a>
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
                                <a class="nav-link dropdown-toggle arrow-none" href="{{url('/')}}/home" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">HOME</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#about" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">About us</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="/portfoliohome" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Our work</span>
                                </a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#contact_us" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Contact us</span>
                                </a>
                            </li>
                            @if (Session::get('email'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{url('/')}}/booking" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Get Ticket</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{url('/')}}/userdashboard" id="topnav-dashboard" role="button">
                                    <i data-feather="home"></i><span data-key="t-dashboards">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-elements">Elements</span> 
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu " aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div>
                                                    <div class="menu-title"></div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-5">
                                                            <div>
                                                                
                                                                <a href="{{url('/')}}/addevent" class="dropdown-item" data-key="t-alerts">Add Event</a>
                                                                <a href="{{url('/manageevent')}}" class="dropdown-item" data-key="t-buttons">Manage events</a>
                                                                {{-- <a href="edititem" class="dropdown-item" data-key="t-cards">edititem</a> --}}
                                                                {{-- <a href="/manageitem" class="dropdown-item" data-key="t-carousel">Manage Customers</a> --}}
                                                                <a href="{{url('/')}}/managebooking" class="dropdown-item" data-key="t-dropdowns">Manage bookings</a>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            @endif

                            @if (Session::get('user_type') == "admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-elements">Admin Dashboard</span> 
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu " aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div>
                                                    <div class="menu-title"></div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-5">
                                                            <div>
                                                                
                                                                <a href="{{url('/')}}/allcustomer" class="dropdown-item" data-key="t-alerts">All customer</a>
                                                                <a href="{{url('/adminallevent')}}" class="dropdown-item" data-key="t-buttons">All events</a>
                                                                {{-- <a href="edititem" class="dropdown-item" data-key="t-cards">edititem</a> --}}
                                                                <a href="{{url('/')}}/adminallbooking" class="dropdown-item" data-key="t-carousel">All bookings</a>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </li>  
                            @endif
                            

                            
                </nav>
            </div>
        </div>

       
</body>

<script>
    function updateNotificationClickTime() {
    // Send an AJAX request to store the last click time
    $.ajax({
        url: "{{ route('notifications.click') }}", // Route to handle the notification click
        type: 'POST', // Ensure it is a POST request
        data: {
            _token: "{{ csrf_token() }}" // Include the CSRF token
        },
        success: function(response) {
            console.log('Notification click time updated');
            fetchUpdatedNotificationCount(); // Fetch the updated notification count
        },
        error: function(response) {
            console.error('Error updating notification click time');
        }
    });
}

function fetchUpdatedNotificationCount() {
    // Send an AJAX request to fetch the updated notification count
    $.ajax({
        url: "{{ route('notifications.count') }}", // Route to get the updated count
        type: 'GET',
        success: function(data) {
            // Update the notification count in the UI
            if(data.unreadCount === 0){
                $('#notificationCount').text(data.unreadCount);
            }
            
        },
        error: function(response) {
            console.error('Error fetching updated notification count');
        }
    });
}
</script>
    
    
