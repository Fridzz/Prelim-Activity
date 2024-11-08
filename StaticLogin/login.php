<!DOCTYPE html>
<html lang="en" data-bs-theme="white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Static Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- Custom Alerts -->
    <div class="alert alert-danger" role="alert" id="alert_danger_custom" style="display: none;">
        <button type="button" class="btn-close" aria-label="Close" id="close_danger"></button>
        Invalid Username/Password!
    </div>

    <div class="alert alert-success" role="alert" id="alert_success_custom" style="display: none;">
        <button type="button" class="btn-close" aria-label="Close" id="close_success"></button>
        Welcome to the System: <span id="user_email"></span>
    </div>

    <!-- Login Form Container -->
    <div class="round-container text-center" id="cntnr">
        <div class="mb-4">
            <img src="images/pic.png" alt="Profile Picture" class="profile-pic">
        </div>

        <!-- Login Form -->
        <form method="post" id="loginForm">
            <div class="mb-3">
                <select class="form-select" name="options" aria-label="User Role">
                    <option value="admin" selected>Admin</option>
                    <option value="Content Manager">Content Manager</option>
                    <option value="System User">System User</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="floatingInput" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">User Name</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="floatingPassword" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <button type="submit" class="btn btn-primary" name="sbtn">SIGN IN</button>
        </form>
    </div>

    <script>
        // Handle alert close actions
        document.getElementById('close_danger')?.addEventListener('click', () => {
            document.getElementById('alert_danger_custom').style.display = 'none';
        });

        document.getElementById('close_success')?.addEventListener('click', () => {
            document.getElementById('alert_success_custom').style.display = 'none';
        });

        // Handle form submission and show the appropriate alerts
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();  // Prevent form submission for AJAX-like behavior
            
            document.getElementById('alert_danger_custom').style.display = 'none';
            document.getElementById('alert_success_custom').style.display = 'none';

            const email = document.getElementById('floatingInput').value;
            const password = document.getElementById('floatingPassword').value;
            const userRole = document.querySelector('select[name="options"]').value;

            const accounts = {
                "admin": { "admin1": "admin123", "admin2": "admin123" },
                "content_manager": { "manager1": "manager123", "manager2": "manager123" },
                "system_user": { "user1": "user123", "user2": "user123" }
            };

            let alert = '';
            if (accounts[userRole]?.[email] === password) {
                alert = 'success';
                document.getElementById('user_email').textContent = email; // Display username on success alert
            } else {
                alert = 'danger';
            }

            if (alert === 'success') {
                document.getElementById('alert_success_custom').style.display = 'block';
            } else if (alert === 'danger') {
                document.getElementById('alert_danger_custom').style.display = 'block';
            }
        });
    </script>

</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $accounts = [
            "admin" => [
                "admin1" => "admin123",
                "admin2" => "admin123"
            ],
            "content_manager" => [
                "manager1" => "manager123",
                "manager2" => "manager123"
            ],
            "system_user" => [
                "user1" => "user123",
                "user2" => "user123"
            ],
        ];

        $email = $_POST['floatingInput'] ?? '';
        $password = $_POST['floatingPassword'] ?? '';
        $role = $_POST['options'] ?? '';

        $alert = '';
        if (isset($accounts[$role][$email]) && $accounts[$role][$email] === $password) {
            $alert = 'success';
        } else {
            $alert = 'danger';
        }

        if ($alert === 'success') {
            echo '<script>document.getElementById("alert_success_custom").style.display = "block";</script>';
        } else {
            echo '<script>document.getElementById("alert_danger_custom").style.display = "block";</script>';
        }
    }
?>
