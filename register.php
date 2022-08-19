<?php
session_start();

 $con = mysqli_connect('localhost', 'root', '', 'social');

 if(mysqli_connect_errno())
 {
     echo "failed to connect to db".mysqli_connect_errno();
 }
 //$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'paul')");

 //declaring variables to prevent errors;
 $fname = "";
 $lname = "";
 $em = "";
 $em2 = "";
 $password = "";
 $password2 = "";
 $date = "";
 $error_array = array();

 if (isset($_POST['register_button']))
 {
    //first name
    $fname = strip_tags($_POST['reg_fname']);//remove htmltags
    $fname = str_replace(' ', '', $fname);//remove spaces
    $fname = ucfirst(strtolower($fname)); //uppercase
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable

    //last name
    $lname = strip_tags($_POST['reg_lname']);//remove htmltags
    $lname = str_replace(' ', '', $lname);//remove spaces
    $lname = ucfirst(strtolower($lname)); //uppercase\
    $_SESSION['reg_lname'] = $lname; //stores last name into session variable

    //email
    $em = strip_tags($_POST['reg_email']);//remove htmltags
    $em = str_replace(' ', '', $em);//remove spaces
    $em = strtolower($em); //uppercase
    $_SESSION['reg_email'] = $em; //stores email into session variable

    //confirm email
    $em2 = strip_tags($_POST['reg_email2']);//remove htmltags
    $em2 = str_replace(' ', '', $em2);//remove spaces
    $em2 = strtolower($em2); //uppercase
    $_SESSION['reg_email2'] = $em2; //stores email2 into session variable

    //Password
    $password = strip_tags($_POST['reg_password']);//remove htmltags

    //Password2
    $password2 = strip_tags($_POST['reg_password2']);//remove htmltags

    $date = date("Y-m-d");

    //email validation
    if($em == $em2)
    {
       if(filter_var($em, FILTER_VALIDATE_EMAIL))
       {
          $em = filter_var($em, FILTER_VALIDATE_EMAIL);
          //check if email already exists
          $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
          //counting numbers of rows returned
          $num_rows = mysqli_num_rows($e_check);
          if($num_rows > 0)
          {
            array_push($error_array, "Email already in use<br>");
          }
       } else 
       {
        array_push($error_array,"Invalid Email Format<br>");
       }
    } else
    {
        array_push($error_array,"emails do not match<br>");
    }
    //first name validation
    if (strlen($fname) > 25 || strlen($fname) < 2)
    {
        array_push($error_array, "your first name must be between 2 or 25 characters<br>");
    }
    // last name validation
    if (strlen($lname) > 25 || strlen($lname) < 2)
    {
        array_push($error_array, "your last name must be between 2 or 25 characters<br>");
    }
    //password validation
    if($password != $password2)
    {
        array_push($error_array, "your passwords do not match<br>");
    } else 
    {
        if(preg_match('/[^A-Za-z0-9]/', $password))
        {
        array_push($error_array, "your password can only contain letters or numbers<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password ) < 8)
    {
        array_push($error_array, "your password must be between 8 and 30 characters<br>");
    }

    if(empty($error_array))
    {
       $password = md5($password); //encrypt passwords before sending to db
       
       //generates username by concatenating firstname and lastname
       $username = strtolower($fname ."_". $lname);
       $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
       $i = 0;
       //add number to username if it already exists
       while(mysqli_num_rows($check_username_query) != 0)
       {
           $i++;
           $username = $username. "_" . $i;
           $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
       }

       //assigning profile picture
       $rand = rand(1, 2);
       if($rand == 1)
           $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
       else if($rand == 2)
           $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
       
       $query = mysqli_query($con, "INSERT INTO users VALUES('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
       array_push($error_array, "<span style='color: #14C800;'>Signup Successful!</span><br>");
       //clear session variables
       $_SESSION['reg_fname'] = "";
       $_SESSION['reg_lname'] = "";
       $_SESSION['reg_email'] = "";
       $_SESSION['reg_email2'] = "";
       $_SESSION['reg_fname'] = "";
    }

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
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

        <input type="email2" name="reg_email2" placeholder="retype your email" value="<?php 
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
    </form>
</body>
</html>