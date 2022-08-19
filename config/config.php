<?php 
ob_start();
session_start();

$timezone = date_default_timezone_set("Africa/Lagos"); //America/Los_Angeles

$con = mysqli_connect('localhost', 'root', '', 'social');

if(mysqli_connect_errno())
{
    echo "failed to connect to db".mysqli_connect_errno();
}
?>