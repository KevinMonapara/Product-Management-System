<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.email_id').keyup(function (e) {
                var email = $('.email_id').val();

                $.ajax({
                    type: "POST",
                    url: "reg_vld.php",
                    data: {
                        // 'check_Emailbtn': 1,
                        email: email,
                    },
                    success: function (data) {
                        // $('.email_error').text(response);
                        if (data != 0) {
                            $('.email_error').html('<span>Email Exist</span>');
                            $("input[type='submit']").prop("disabled", true);
                        }
                    },
                    error: function () { }
                })
            });
        });

        $(document).ready(function () {
            $('.user_s').keyup(function (e) {
                var user = $('.user_s').val();

                $.ajax({
                    type: "POST",
                    url: "reg_vld.php",
                    data: {
                        // 'check_userbtn': 1,
                        username: user,
                    },
                    success: function (data) {
                        // $('.user_error').text(response);
                        if (data != 0) {
                            $('.user_error').html('<span>Username Exist</span>');
                            $("input[type='submit']").prop("disabled", true);
                        }
                    },
                    error: function () { }
                })
            });
        });
    </script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .error,
        .email_error,
        .user_error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">

        <?php
        include "config/database.php";

        if (isset ($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['pswd'];

            $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");

            if (mysqli_num_rows($verify_query) != 0) {
                echo "<div class='message mt-5'>
                        <p>This email is used, Try another One Please!</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn btn-danger'>Go Back</button>";
            } else {
                mysqli_query($conn, "INSERT INTO users(username,email,pswd) VALUES('$username','$email','$password')") or die ("Error Occur");
                echo "<div class='message mt-5'>
                        <p>Registration successful!</p> 
                      </div> <br>";
                echo "<a href='index.php'><button class='btn btn-success'>Login Now</button>";
            }
        } else {

            ?>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <form action="" id="rfrm" method="post">
                            <h2 class="h2 mt-5 mb-4 text-center">Register User</h2>
                            <div>
                                <label for="username" class="form-label">Username : </label>
                                <input type="text" class="form-control user_s" name="username" id="username"
                                    autocomplete="off">
                                <span class="user_error"></span>
                            </div>
                            <br>
                            <div>
                                <label for="email" class="form-label">Email : </label>
                                <input type="text" class="form-control email_id" name="email" id="email" autocomplete="off">
                                <span class="email_error"></span>
                            </div>
                            <br>
                            <div>
                                <label for="password" class="form-label">Password : </label>
                                <input type="password" class="form-control" name="pswd" id="password" autocomplete="off">
                            </div>
                            <br>
                            <div>
                                <input type="submit" id="register" class="btn btn-primary" name="submit" value="Register"
                                    required>
                            </div>
                            <br>
                            <div>
                                Already User? <a href="index.php">Sign In</a>
                            </div>
                        </form>
                        <script src="valid_rfrm.js"></script>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>

</body>

</html>
