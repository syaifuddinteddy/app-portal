<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-left">
        <div class="navbar-brand">
            <span class="hidden-xs">Web Admin Portal Bojonegoro</span>
        </div>
    </div>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="{{ URL::to('images/favicon.png') }}" class="user-image" />
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">My Account</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        <img src="{{ URL::to('images/favicon.png') }}" class="img-circle" />
                        <p>
                            {{Auth::user()->username}}
                            <small><?php echo date('d-m-Y');?></small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="{{URL::route('logout')}}" class="btn btn-danger btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
