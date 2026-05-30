<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f5efe6;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #ffffff;
            padding: 12px 15px;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #ffc107;
            color: #000000;
        }

        .content {
            flex: 1;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                top: 0;
                height: 100vh;
                z-index: 1050;
                transition: left 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                width: 100%;
            }
        }

        .dropdown-menu .dropdown-item {
            transition: 0.2s;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #ffc107;
            color: #000000;
        }

        .chart-box {
            position: relative;
            height: 230px;
            width: 100%;
        }
    </style>
</head>

<body>

    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast bg-success text-white">
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast bg-danger text-white">
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar bg-dark p-3" id="sidebar">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-white mb-0">
                    <i class="bi bi-book"></i> Library
                </h4>

                <button class="btn btn-warning btn-sm d-md-none" id="closeSidebar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link @if(Request::is('dashboard')) active @endif">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/users" class="nav-link @if(Request::is('users')) active @endif">
                        <i class="bi bi-people me-2"></i> Users Management
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/books" class="nav-link @if(Request::is('books')) active @endif">
                        <i class="bi bi-book-half me-2"></i> Book Library
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content">

            <!-- Navbar -->
            <nav class="navbar navbar-dark bg-dark px-3">
                <div class="container-fluid">

                    <button class="btn btn-warning d-md-none me-2" id="toggleSidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <span class="navbar-brand mb-0 h1">@yield('title', 'Dashboard')</span>

                    <div class="dropdown ms-auto">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('user')->email }}
                            <i class="bi bi-person-circle ms-2"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/profile">
                                    <i class="bi bi-person me-2"></i> Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>



    <script>
        const toggleSidebar = document.getElementById("toggleSidebar");
        const closeSidebar = document.getElementById("closeSidebar");
        const sidebar = document.getElementById("sidebar");

        if (toggleSidebar && sidebar) {
            toggleSidebar.addEventListener("click", function() {
                sidebar.classList.add("show");
            });
        }

        if (closeSidebar && sidebar) {
            closeSidebar.addEventListener("click", function() {
                sidebar.classList.remove("show");
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const togglePasswordButton = document.getElementById("togglePassword");

            const confirmInput = document.getElementById("confirmpassword");
            const toggleConfirmBtn = document.getElementById("toggleConfirmPassword");

            if (passwordInput && togglePasswordButton) {
                togglePasswordButton.addEventListener("click", function() {
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        togglePasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    } else {
                        passwordInput.type = "password";
                        togglePasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
                    }
                });
            }

            if (confirmInput && toggleConfirmBtn) {
                toggleConfirmBtn.addEventListener("click", function() {
                    if (confirmInput.type === "password") {
                        confirmInput.type = "text";
                        toggleConfirmBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    } else {
                        confirmInput.type = "password";
                        toggleConfirmBtn.innerHTML = '<i class="bi bi-eye"></i>';
                    }
                });
            }

            const toastElList = document.querySelectorAll('.toast');

            toastElList.forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            });
        });
    </script>

    @yield('scripts')
</body>

</html>