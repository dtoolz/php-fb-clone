<?php
 require 'config/config.php';

 if(isset($_SESSION['username']))
 {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
 } else {
    header("Location: register.php");
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fbclone</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="top_bar">
     <div class="logo">
        <a href="index.php">FBclone</a>
     </div>

     <nav>
        <a href="<?php echo $userLoggedIn; ?>"> <?php echo $user['first_name']; ?> </a>
        <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a>
        <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
        <a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</a>
        <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Friends</a>
        <a href="includes/handlers/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
     </nav>
  </div>

  <div class="wrapper">

