<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var rememberMeEmail = getCookie('remember_me');
            var rememberMePass = getCookie('remember_ps');
            if (rememberMeEmail) {
                document.getElementById('email').value = decodeURIComponent(rememberMeEmail);
                document.getElementById('remember').checked = true;
            }
            if (rememberMePass) {
                document.getElementById('password').value = decodeURIComponent(rememberMePass);
                document.getElementById('remember').checked = true;
            }
        });

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
    </script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .error {
            color: red;
            margin-top: 2px;
        }
    </style>
</head>

<body>

    <?php

    include "config/database.php";

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pswd']);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND pswd='$password' ") or die("Select Error");
        $row = mysqli_fetch_assoc($result);

        if (is_array($row) && !empty($row)) {
            $_SESSION['valid'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];

            if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                setcookie('remember_me', $email, time() + 60, "/");
                setcookie('remember_ps', $password, time() + 60, "/");
            }

            header("Location: data.php");
            exit();
        } else {
            $error = "Wrong Username or Password";
        }
    }

    ?>

    <div class="container">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-4">
                    <form action="" id="frm" method="post">
                        <h2 class="h2 mt-5 mb-4 text-center">Login User</h2>
                        <div>
                            <label for="email" class="form-label">Email : </label>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                        </div>
                        <br>
                        <div>
                            <label for="password" class="form-label">Password : </label>
                            <input type="password" class="form-control" name="pswd" id="password" autocomplete="off">
                        </div>
                        <br>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <div>
                            <input type="checkbox" name="remember" id="remember"> Remember Me
                        </div>
                        <br>
                        <div>
                            <input type="submit" class="btn btn-primary" name="submit" value="Login" required>
                        </div>
                        <br>
                        <div>
                            Don't have account? <a href="register.php">Sign Up Now</a>
                        </div>
                    </form>
                    <script src="valid_lfrm.js"></script>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
