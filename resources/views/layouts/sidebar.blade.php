<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="images/users/avatar-2.jpg" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">Patrick Becker</a>
                <p class="text-body mt-1 mb-0 font-size-13">UI/UX Designer</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{url('/dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Dashboard</span>
                    </a>
                   {{-- <ul class="sub-menu" aria-expanded="false">

                        <li><a href="index-2">Dashboard 2</a></li>
                    </ul>--}}
                </li>

                <li>
                    <a href="{{route('getCompanies')}}" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Company</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('getProducts')}}" class="has-arrow waves-effect">
                        <i class="mdi mdi-dolly"></i>
                        <span>Product</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
