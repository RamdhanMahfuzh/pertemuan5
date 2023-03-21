<?php

include "server/connection.php";
$id = $_GET['user_id'];
$name = $_POST['user_name'];
$email = $_POST['user_email'];
$query = "UPDATE users SET user_name = '$name', user_email = '$email' WHERE user_id = '$id' ";
mysqli_query($conn, $query);
header("location:welcome.php");

die();
