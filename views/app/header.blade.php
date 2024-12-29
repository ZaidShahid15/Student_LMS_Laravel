<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow" style="z-index: 99;">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="d-flex gap-3">
            <!-- Logo and Brand -->
            <div class="d-flex align-items-center">
                <i class="bi bi-browser-edge  fs-3"><span class="ps-2  fw-bold">LMS</span></i>
                {{-- <img src="{{ asset('pic/logo.png') }}" style="width: 100px;" alt="Logo"> --}}
            </div>
            <div class="d-flex  align-items-center" id="display-modal-btn" style="margin-left:2vw;">
                <span data-bs-toggle="modal" data-bs-target="#sidebarModal" class="nav-link"><i
                        class="bi bi-list  fs-2 text-dark fw-bold"></i></span>
            </div>
            <div class="d-flex  align-items-center" id="displaye-sidbar-btn" style="margin-left:6vw;">
                <span class="nav-link icon-list"><i class="bi bi-list  fs-2 text-dark fw-bold"></i></span>
            </div>
        </div>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav gap-3 mb-2 mb-lg-0 d-flex align-items-center">
                <li class="nav-item d-none d-lg-block">
                    <form>
                        <div class="d-flex border">
                            <input class="form-control border-0 shadow-none me-2" name="search" style="width: 300px"
                                value="{{ request()->input('search') }}" type="search" placeholder="Search">
                            <button class="bg-white border-0" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Search Icon (visible on smaller screens) -->
        <button class="navbar-toggler shadow-none d-lg-none" type="button" data-bs-toggle="modal"
            data-bs-target="#searchModal">
            <span class="bi bi-search"></span>
        </button>

        <!-- Dropdown -->
        <div class="dropdown me-3">
            <button class="border-0 bg-white dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                <li><a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">profile</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal for Search Bar -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="d-flex justify-content-between border">
                    <input class="form-control border-0 shadow-none me-2" name="search" style="width: 300px"
                        value="{{ request()->input('search') }}" type="search" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
