<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
    id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    Currency
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown ">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center text-white font-weight-bold">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">
                                {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <h5 class="text-overflow m-0">Welcome!</h5>
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="ni ni-circle-08 me-sm-1"></i>
                            <span>Profile</span>
                        </a>
                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link px-0">
                                <i class="ni ni-button-power me-sm-1"></i>
                                <span class="d-sm-inline">Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:void(0)" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
