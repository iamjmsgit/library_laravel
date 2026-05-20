<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f5efe6;
        }

        .content {
            flex: 1;
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

        <!-- Main Content -->
        <div class="content">

            <!-- Navbar -->
            <nav class="navbar navbar-dark bg-dark sticky-top ">
                <div class="container-fluid m-2">
                    <a href="/dashboard" class="d-flex align-items-center text-white text-decoration-none">
                        <i class="fa-sharp fa-solid fa-angle-left fs-4 me-2 lh-1"></i>
                        <h5 class="fw-bold mb-0 lh-1">Back to Dashboard</h5>
                    </a>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container p-4">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function togglePassword(inputId, buttonId) {
                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);

                if (input && button) {
                    button.addEventListener("click", function() {
                        if (input.type === "password") {
                            input.type = "text";
                            button.innerHTML = '<i class="bi bi-eye-slash"></i>';
                        } else {
                            input.type = "password";
                            button.innerHTML = '<i class="bi bi-eye"></i>';
                        }
                    });
                }
            }

            togglePassword("password", "togglePassword");
            togglePassword("new_pass", "toggleNewPassword");
            togglePassword("confirm_pass", "toggleConfirmPassword");
            togglePassword("confirmpassword", "toggleConfirmPassword");

            const toastElList = document.querySelectorAll('.toast');

            toastElList.forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            });
        });
    </script>


</body>

</html>