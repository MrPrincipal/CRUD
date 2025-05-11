<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Animation styles */
        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            50% { transform: translateX(10px); }
            75% { transform: translateX(-10px); }
            100% { transform: translateX(0); }
        }

        .fadeIn {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Styling for the login form */
        .card {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
    <script>
        function validateLogin() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const form = document.getElementById('loginForm');
            
            // Define the correct username and password
            const correctUsername = 'Prince09';
            const correctPassword = '#*Prince909}';
            
            if (username === correctUsername && password === correctPassword) {
                <?php $_SESSION['username'] = 'Prince09'; ?>
                window.location.href = 'manage.php';
            } else {
                form.classList.add('shake');
                
                setTimeout(() => {
                    form.classList.remove('shake');
                }, 500);
                
                alert('Invalid Username or Password');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login</h3>
                        <form id="loginForm" onsubmit="event.preventDefault(); validateLogin();">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
