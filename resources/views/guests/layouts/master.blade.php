<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="r3Bdu0Td_e-yJ7g8HQidTiVYt2aM_OVVJtwTRviXBfY" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.6/datatables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">


    @stack('title')

    <style>
        #bars{
            display: none;
        }
        @media screen and (min-width: 993px) {
            #navigation {
                display: none;
            }
        }
        @media screen and (max-width: 575px) {
    #bars {
        display: block;
    }
}
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

<body>
    <nav class="navbar navbar-expand navbar-dark navbar-light" style="position: sticky;top: 0px;z-index: 1;">
        <ul class="navbar-nav">
            {{-- <li class="nav-item d-sm-inline-block" >
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li> --}}
            <li class="nav-item" id="bars">
                <a class="nav-link" data-widget="pushmenu" style="width: 50px; height: 50px; border-radius: 10%; object-fit: cover;">
                    <i class="fas fa-bars"></i>
                </a>
            </li>


            <li class="nav-item d-none d-sm-inline-block" >
                <img src="{{ asset('favicon.ico') }}" alt="Logo" data-widget="pushmenu" style="width: 50px; height: 50px; border-radius: 10%; object-fit: cover;">
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('aboutus') }}" class="nav-link">About Us</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('blog') }}" class="nav-link">Blog</a>
            </li>
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                @php
                    $categories = App\Models\Category::all();
                @endphp
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('category.filter', Crypt::encrypt($category->id)) }}">{{ ucfirst( Crypt::decrypt($category->name)) }}</a>
                    @endforeach
                    <a class="dropdown-item" href="{{ route('/') }}">Reset Filter</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            @if (auth()->user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile',['id'=>Crypt::encrypt(auth()->user()->id)]) }}">Profile</a>
                        <div class="dropdown-divider"></div> <!-- Optional: Add a divider -->
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a> <!-- Optional: Logout link -->
                    </div>
                </li>
            @else
                <li class="nav-item  d-sm-inline-block">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
            @endif
        </ul>

    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4" id="navigation"     style="position: fixed;">
        <div class="sidebar">
            <ul class="navbar-nav">
                <li class="nav-item d-flex" style="justify-content: space-between;">
                    <img src="{{ asset('favicon.ico') }}" alt="" data-widget="pushmenu" style="width: 50px; height: 50px; border-radius: 10%; object-fit: cover;">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-xmark"></i></a>
                </li>
                <li class="nav-item  d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item  d-sm-inline-block">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>
                <li class="nav-item  d-sm-inline-block">
                    <a href="{{ route('aboutus') }}" class="nav-link">About Us</a>
                </li>
                <li class="nav-item  d-sm-inline-block">
                    <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item dropdown  d-sm-inline-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    @php
                        $categories = App\Models\Category::all();
                    @endphp
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{ route('category.filter', Crypt::encrypt($category->id)) }}">{{ ucfirst( Crypt::decrypt($category->name)) }}</a>
                        @endforeach
                        <a class="dropdown-item" href="{{ route('/') }}">Reset Filter</a>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

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

    <div class="content">
        @yield('content')
    </div>

    <footer class="footer text-center mt-4">
        <div class="container">
            <p class="text-muted">
                &copy; {{ date('Y') }} <a href="{{ route('/') }}">my-amazone</a>. All rights reserved.
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.6/datatables.min.js"></script>
    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
