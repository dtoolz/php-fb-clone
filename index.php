<?php
 $con = mysqli_connect('localhost', 'root', '', 'social');

 if(mysqli_connect_errno())
 {
     echo "failed to connect to db".mysqli_connect_errno();
 }
 //$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'paul')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    Hello reece!
</body>
</html>