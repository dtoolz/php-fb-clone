<?php
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