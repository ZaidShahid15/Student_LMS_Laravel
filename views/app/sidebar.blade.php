<div class="sidebar p-3 shadow bg-white" style="overflow-y: auto; max-height: calc(100vh - 60px); padding: 0;">
    <div class="p-3" style="margin-top: 40px;">
        <ul class="list-unstyled" id="sidebar-nav">
            <li class="nav-item border {{ request()->routeIs('home') ? 'active' : '' }} fs-5 fw-bold rounded-0 mb-3">
                <a href="{{ route('home') }}" class="nav-link collapsed nav-hover d-flex align-items-center {{ request()->routeIs('home') ? 'text-white' : 'nav-hover' }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                    <i class="bi bi-house fw-bold"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            @if(!empty(Gate::allows('category', App\Models\roles_permission::class)))
            <li class="nav-item {{ request()->routeIs('cetagori') ? 'active' : '' }} fs-5 mb-3 border">
                <a class="nav-link collapsed d-flex gap-3 nav-hover align-items-center {{ request()->routeIs('cetagori') ? 'text-white' : 'nav-hover' }}" href="{{ route('cetagori') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                    <i class="bi bi-nintendo-switch"></i>
                    <span class="ms-2">Category</span>
                </a>
            </li>
            @endif

            @if (!empty(Gate::allows('AuthView', App\Models\roles_permission::class)))
            <li class="nav-item {{ request()->routeIs('auther') ? 'active' : '' }} fs-5 mb-3 border">
                <a class="nav-link collapsed d-flex gap-3 nav-hover align-items-center {{ request()->routeIs('auther') ? 'text-white' : 'nav-hover' }}" href="{{ route('auther') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                    <i class="ri-user-3-line"></i>
                    <span class="ms-2">Author</span>
                </a>
            </li>
            @endif

            @if (!empty(Gate::allows('BookView', App\Models\roles_permission::class)))
            <li class="nav-item {{ request()->routeIs('books') ? 'active' : '' }} mb-3 fs-5 border">
                <a class="nav-link collapsed d-flex gap-3 nav-hover align-items-center {{ request()->routeIs('books') ? 'text-white' : 'nav-hover' }}" href="{{ route('books') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                    <i class="ri-git-repository-line"></i>
                    <span class="ms-2">Books</span>
                </a>
            </li>
            @endif

            @if(!empty(Gate::allows('IssuedBookview', App\Models\roles_permission::class)))
            <li class="nav-item {{ request()->routeIs('book-issued') ? 'active' : '' }} fs-5 border">
                <a class="nav-link collapsed nav-hover d-flex gap-3 align-items-center {{ request()->routeIs('book-issued') ? 'text-white' : 'nav-hover' }}" href="{{ route('book-issued') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                    <i class="ri-pass-valid-line"></i>
                    <span class="ms-2">Book Issued</span>
                </a>
            </li>
            @endif

            @php
                // Check if any form child is active
                $isFormsActive = request()->routeIs('roles') || request()->routeIs('add_Student');
            @endphp

            @if (!empty(Gate::allows('Rolesview',App\Models\roles_permission::class)) || !empty(Gate::allows('StudentView',App\Models\roles_permission::class)))

            <li class="nav-item rounded">
                <a class="nav-link collapsed mb-3 fs-6 fw-bold nav-hover d-flex  border mt-3 align-items-center justify-content-between" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" style="transition: background-color 0.3s;">
                    <i class="bi bi-journal-text"></i>
                    <span class="ms-2">Forms</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content {{ $isFormsActive ? 'show' : 'collapse' }} text-dark list-unstyled p-2">
                        @if (!empty(Gate::allows('Rolesview',App\Models\roles_permission::class)) )
                            <li class="nav-item {{ request()->routeIs('roles') ? 'active' : '' }} rounded nav-hover rounded-0 fs-6 mb-3 border">
                                <a class="nav-link collapsed d-flex gap-3  align-items-center {{ request()->routeIs('roles') ? 'text-white' : 'nav-hover' }}" href="{{ route('roles') }}" style="transition: background-color 0.3s;">
                                    <i class="bi bi-menu-up"></i>
                                    <span class="ms-2">Roles</span>
                                </a>
                            </li>
                        @endif

                        @if (!empty(Gate::allows('StudentView',App\Models\roles_permission::class)))
                            <li class="nav-item {{ request()->routeIs('add_Student') ? 'active' : '' }} rounded nav-hover rounded-0 fs-6 mb-3 border">
                                <a class="nav-link collapsed d-flex gap-3  align-items-center {{ request()->routeIs('add_Student') ? 'text-white' : 'nav-hover' }}" href="{{ route('add_Student') }}" style="transition: background-color 0.3s;">
                                    <i class="ri-graduation-cap-line"></i>
                                    <span class="ms-2">Student</span>
                                </a>
                            </li>
                        @endif


                </ul>
            </li>
            @endif
                @if (Gate::allows('is-student'))
                <li class="nav-item {{ request()->routeIs('Issued_books') ? 'active' : '' }} fs-5 border">
                    <a class="nav-link collapsed nav-hover d-flex gap-3 align-items-center {{ request()->routeIs('Issued_books') ? 'text-white' : 'nav-hover ' }}" href="{{ route('Issued_books') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                        <i class="ri-pass-valid-line"></i>
                        <span class="ms-2">Issued Books</span>
                    </a>
                </li>
                @endif
                @if (!empty(Gate::allows('RequestView',App\Models\roles_permission::class)))
                <li class="nav-item {{ request()->routeIs('Request') ? 'active' : '' }} fs-5 border">
                    <a class="nav-link collapsed nav-hover d-flex gap-3 align-items-center {{ request()->routeIs('Request') ? 'text-white' : 'nav-hover ' }}" href="{{ route('Request') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                        <i class="ri-pass-valid-line"></i>
                        <span class="ms-2">Check Requtes</span>
                    </a>
                </li>
                @endif


        </ul>
    </div>
</div>




<!-- Modal (for small screens) -->
<div class="modal d-lg-none" id="sidebarModal" tabindex="-1" aria-labelledby="sidebarModalLabel">
    <div class="modal-dialog  modal-dialog-slideout">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sidebarModalLabel">Sidebar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Sidebar content (same as the original sidebar) -->
                <div class="p-3">

                    <ul class="list-unstyled" id="sidebar-nav">
                        <li class="nav-item border {{ request()->routeIs('home') ? 'active' : '' }} fs-5 fw-bold rounded-0 mb-3">
                            <a href="{{ route('home') }}" class="nav-link collapsed nav-hover d-flex align-items-center {{ request()->routeIs('home') ? 'text-white' : 'nav-hover' }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                                <i class="bi bi-house fw-bold"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>
                        @if (!empty($permissioncategori))
                        <li class="nav-item {{ request()->routeIs('cetagori') ? 'active' : '' }} fs-5 mb-3 border">
                            <a class="nav-link collapsed d-flex gap-3 nav-hover align-items-center {{ request()->routeIs('cetagori') ? 'text-white' : 'nav-hover' }}" href="{{ route('cetagori') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                                <i class="bi bi-nintendo-switch"></i>
                                <span class="ms-2">Category</span>
                            </a>
                        </li>
                        @endif

                        @if (!empty($permissionAuthor))
                        <li class="nav-item {{ request()->routeIs('auther') ? 'active' : '' }} fs-5 mb-3 border">
                            <a class="nav-link collapsed d-flex gap-3 nav-hover align-items-center {{ request()->routeIs('auther') ? 'text-white' : 'nav-hover' }}" href="{{ route('auther') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                                <i class="ri-user-3-line"></i>
                                <span class="ms-2">Author</span>
                            </a>
                        </li>
                        @endif

                        @if (!empty($permissionbook))
                        <li class="nav-item {{ request()->routeIs('books') ? 'active' : '' }} mb-3 fs-5 border">
                            <a class="nav-link collapsed d-flex gap-3 nav-hover align-items-center {{ request()->routeIs('books') ? 'text-white' : 'nav-hover' }}" href="{{ route('books') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                                <i class="ri-git-repository-line"></i>
                                <span class="ms-2">Books</span>
                            </a>
                        </li>
                        @endif

                        @if(!empty($permissionbookIssue))
                        <li class="nav-item {{ request()->routeIs('book-issued') ? 'active' : '' }} fs-5 border">
                            <a class="nav-link collapsed nav-hover d-flex gap-3 align-items-center {{ request()->routeIs('book-issued') ? 'text-white' : 'nav-hover' }}" href="{{ route('book-issued') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                                <i class="ri-pass-valid-line"></i>
                                <span class="ms-2">Book Issued</span>
                            </a>
                        </li>
                        @endif

                        @php
                            // Check if any form child is active
                            $isFormsActive = request()->routeIs('roles') || request()->routeIs('add_Student');
                        @endphp

                        @if (!empty($permissionrole) || !empty($permissionStudent))

                        <li class="nav-item rounded">
                            <a class="nav-link collapsed mb-3 fs-6 fw-bold nav-hover d-flex text-dark border mt-3 align-items-center justify-content-between" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" style="transition: background-color 0.3s;">
                                <i class="bi bi-journal-text"></i>
                                <span class="ms-2">Forms</span>
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <ul id="forms-nav" class="nav-content {{ $isFormsActive ? 'show' : 'collapse' }} text-dark list-unstyled p-2">
                                    @if (!empty($permissionrole))
                                        <li class="nav-item {{ request()->routeIs('roles') ? 'active' : '' }} rounded nav-hover rounded-0 fs-6 mb-3 border">
                                            <a class="nav-link collapsed d-flex gap-3  align-items-center {{ request()->routeIs('roles') ? 'text-white' : 'nav-hover' }}" href="{{ route('roles') }}" style="transition: background-color 0.3s;">
                                                <i class="bi bi-menu-up"></i>
                                                <span class="ms-2">Roles</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($permissionStudent))
                                        <li class="nav-item {{ request()->routeIs('add_Student') ? 'active' : '' }} rounded nav-hover rounded-0 fs-6 mb-3 border">
                                            <a class="nav-link collapsed d-flex gap-3  align-items-center {{ request()->routeIs('add_Student') ? 'text-white' : 'nav-hover' }}" href="{{ route('add_Student') }}" style="transition: background-color 0.3s;">
                                                <i class="ri-graduation-cap-line"></i>
                                                <span class="ms-2">Student</span>
                                            </a>
                                        </li>
                                    @endif


                            </ul>
                        </li>
                        @endif
                            @if (Gate::allows('is-student'))
                            <li class="nav-item {{ request()->routeIs('Issued_books') ? 'active' : '' }} fs-5 border">
                                <a class="nav-link collapsed nav-hover d-flex gap-3 align-items-center {{ request()->routeIs('Issued_books') ? 'text-white' : 'nav-hover ' }}" href="{{ route('Issued_books') }}" style="transition: background-color 0.3s; font-weight:300; font-size:16px;">
                                    <i class="ri-pass-valid-line"></i>
                                    <span class="ms-2">Issued Books</span>
                                </a>
                            </li>
                            @endif


                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
