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
            background: linear-gradient(135deg, #212529, #2f241d);
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

    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
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
</body>

</html>