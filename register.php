<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./assets/js/register.js"></script>
</head>
<body>

    <?php
        if(isset($_POST['register_button']))
        {
            echo '
               <script>
                   $(document).ready(function(){
                       $("#first").hide();
                       $("#second").show();
                   });
               </script>
            ';
        }
    ?>

    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h3>Social  Clone</h3>
                Login or Sign-Up
            </div>
            <div id="first">
                <form action="register.php" method="POST">
                <input type="email" name="log_email" placeholder="type in your email address" value="<?php 
                    if(isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    }
                    ?>" required><br>
                <input type="password" name="log_password" placeholder="type in your password"><br>
                <?php if(in_array("Email or Password incorrect<br>", $error_array)) echo "Email or Password incorrect<br>"; ?>
                <input type="submit" name="login_button" value="Login">
                <a href="#" id="signup" class="signup">Need an account? register here</a>
                </form>
            </div>

            <div id="second">
                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="type in your first name" value="<?php 
                    if(isset($_SESSION['reg_fname'])) {
                        echo $_SESSION['reg_fname'];
                    }
                    ?>" required>
                    <br>
                    <?php if(in_array("your first name must be between 2 or 25 characters<br>", $error_array)) echo "your first name must be between 2 or 25 characters<br>";?>

                    <input type="text" name="reg_lname" placeholder="type in your last name" value="<?php 
                    if(isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    }
                    ?>" required>
                    <br>
                    <?php if(in_array("your last name must be between 2 or 25 characters<br>", $error_array)) echo "your last name must be between 2 or 25 characters<br>";?>

                    <input type="email" name="reg_email" placeholder="type in your email" value="<?php 
                    if(isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    }
                    ?>" required>
                    <br>
                    <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
                    else if(in_array("Invalid Email Format<br>", $error_array)) echo "Invalid Email Format<br>";
                    else if(in_array("emails do not match<br>", $error_array)) echo "emails do not match<br>"; ?>

                    <input type="email" name="reg_email2" placeholder="retype your email" value="<?php 
                    if(isset($_SESSION['reg_email2'])) {
                        echo $_SESSION['reg_email2'];
                    }
                    ?>" required>
                    <br>
                    <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
                    else if(in_array("Invalid Email Format<br>", $error_array)) echo "Invalid Email Format<br>";
                    else if(in_array("emails do not match<br>", $error_array)) echo "emails do not match<br>"; ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>

                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                    <?php if(in_array("your password can only contain letters or numbers<br>", $error_array)) echo "your password can only contain letters or numbers<br>";?>
                    <?php if(in_array("your passwords do not match<br>", $error_array)) echo "your passwords do not match<br>";?>
                    <?php if(in_array("your password must be between 8 and 30 characters<br>", $error_array)) echo "your password must be between 8 and 30 characters<br>";?>

                    <input type="submit" name="register_button" value="Register">
                    <br>
                    <?php if(in_array("<span style='color: #14C800;'>Signup Successful!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Signup Successful!</span><br>";?>
                    <a href="#" id="signin" class="signin">Already have an account? login here</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>