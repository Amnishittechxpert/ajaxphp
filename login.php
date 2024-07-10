<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <form id="loginForm" method="post">
            <div class="form-group">
                <label for="loginName">Name:</label>
                <input type="text" class="form-control" id="loginName" name="loginName" placeholder="Enter name">
                <span class="error" id="nameErr"></span>
            </div>
            <div class="form-group">
                <label for="loginEmail">Email:</label>
                <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email">
                <span class="error" id="emailErr"></span>
            </div>
            <button type="button" class="btn btn-primary" id="loginBtn">Login</button>
            <a href="signup.php" class="btn btn-primary">Sign Up</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#loginBtn').click(function() {
            var loginName = $('#loginName').val();
            var loginEmail = $('#loginEmail').val();

            $('.error').text('');

            var valid = true;

            if (loginName === '') {
                $('#nameErr').text('Name is required');
                valid = false;
            }

            if (loginEmail === '') {
                $('#emailErr').text('Email is required');
                valid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(loginEmail)) {
                $('#emailErr').text('Invalid email format');
                valid = false;
            }

            if (!valid) {
                return; // Exit if there are validation errors
            }

            // Send data to server using Ajax
            $.ajax({
                type: 'POST',
                url: 'process_login.php',
                data: {
                    loginName: loginName,
                    loginEmail: loginEmail,
                    login: true
                },
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = 'dashboard.php';
                    } else {
                        alert('Login failed. Please check your credentials.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
    </script>
</body>
</html>
