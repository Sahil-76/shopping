<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="https://cdn.datatables.net/v/dt/dt-2.1.6/datatables.min.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    {{-- summer note --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

    {{-- ajax cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    @stack('title')
    <style>
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
            color: #6c757d;
        }
    </style>
</head>
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position: sticky;
    top: 0px;">
    <ul class="navbar-nav">
        <li class="nav-item" id="bars">
            <a class="nav-link" data-widget="pushmenu" style="width: 50px; height: 50px; border-radius: 10%; object-fit: cover;">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">Dashboard</a>
        </li>
        @php
        use App\Models\Contact;
        use Carbon\Carbon;
            $todayContactCount=Contact::whereDate('created_at', Carbon::today())->count();
        @endphp
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('contact/request')}}" class="nav-link">Users Contact Request
            @if($todayContactCount > 0)
        <span class="badge bg-danger">{{ $todayContactCount }}</span> 
    @endif</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">


        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{-- @foreach ($users as $user)
                    <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}"
                        class="img-circle elevation-2" alt="User Image" style="width: 3rem;">
                @endforeach --}}
                Profile
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Profile</span>
                <div class="dropdown-divider"></div>
                {{-- <a href="{{ url('users.show', auth()->user()->id) }}" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> Profile
                </a> --}}
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile',Crypt::encrypt(auth()->user()->id)) }}" class="dropdown-item">
                    <i class="fas fa-lock mr-2"></i> Change Passowrd
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fas fa-sign-out mr-2"></i> Logout
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>

    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="    position: fixed;">
    <a href="{{ url('/') }}" class="brand-link d-flex align-items-center">
        <img src="{{ asset('favicon.ico') }}" alt="logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light d-flex">{{ auth()->user() ? auth()->user()->name : '' }}
            &nbsp;&nbsp;<i class="fa-solid fa-xmark nav-link" data-widget="pushmenu" href="#"
                role="button"></i></span>
    </a></a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3">
            <div class="image">

                {{-- @foreach ($users as $user)
                    <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}"
                        class="img-circle elevation-2" alt="User Image">
                @endforeach --}}
            </div>
            <div class="info">
                {{-- <a
                    href="{{ url('users.show', auth()->user()->id) }}"><b>{{ auth()->user() ? auth()->user()->name : 'Guest' }}</b></a>
            </div> --}}
            </div>

            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    {{-- @if (auth()->user()->hasRole('Admin')) --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Role
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}"
                                    class="nav-link {{ Request::is('admin/roles') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.create') }}"
                                    class="nav-link {{ Request::is('admin/roles/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Category
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}"
                                    class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}"
                                    class="nav-link {{ Request::is('admin/categories/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/brands*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Brands
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('brands.index') }}"
                                    class="nav-link {{ Request::is('admin/brands') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Brands</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brands.create') }}"
                                    class="nav-link {{ Request::is('admin/brands/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Brand</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}"
                                    class="nav-link {{ Request::is('admin/products') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}"
                                    class="nav-link {{ Request::is('admin/products/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('admin/blogs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Blogs
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('blogs.index') }}"
                                    class="nav-link {{ Request::is('admin/blogs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Blogs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('blogs.create') }}"
                                    class="nav-link {{ Request::is('admin/blogs/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New Blog</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Website
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('contacts.index') }}"
                                    class="nav-link {{ Request::is('admin/contacts') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Contact</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('aboutus.index') }}"
                                    class="nav-link {{ Request::is('admin/aboutus') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>About</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                </ul>
            </nav>
        </div>
</aside>

<body>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif (Session::has('fail'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "{{ session('fail') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif


    <div class="content-wrapper">


        @yield('content')
    </div>

</body>
<!--script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script-->

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.datatables.net/v/dt/dt-2.1.6/datatables.min.js"></script>

<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
<footer class="footer text-center mt-4">
    <div class="container">
        <p class="text-muted">
            &copy; {{ date('Y') }} <a href="{{ route('/') }}">my-amazone</a>. All rights reserved.
        </p>
    </div>
</footer>

</div>

</html>
