<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ADB</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Administrator Page</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="">{{ auth()->user()->nama }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if(auth()->user()->foto)
                            <img src="{{ asset('img/profile/' . auth()->user()->foto) }}" class="img-circle" alt="User Image" style=" margin-top: 10%; ">
                            @else
                            <img src="{{ asset('img/profile/default.png') }}" class="img-circle" alt="User Image" style=" margin-top: 10%; ">
                            @endif
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.profile')}}" class="btn btn-default btn-flat">Akun Saya</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>