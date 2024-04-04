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
    <style>
        body {
            background-image: url(images/bgimg.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
                setcookie('remember_me', $email, time() + 86400, "/");
            }

        } else {
            echo "<div class='container mt-5'>
                         <div class='row'>
                           <div class='col d-flex justify-content-center'>
                              <div>
                                <p>Wrong Username or Password</p>
                                <a href='index.php'><button class='btn btn-primary'>Go Back</button>
                              </div>
                           </div>
                         </div>
                      </div>";
        }

        if (isset($_SESSION['valid'])) {
            header("Location: data.php");
        }
    } else {

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
                            <div>
                                <input type="checkbox" name="remember"> Remember Me
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

    <?php } ?>

</body>

</html>
