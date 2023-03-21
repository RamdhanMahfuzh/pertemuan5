<?php
include "server/connection.php";
$id = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_POST['btn_update'])) {

    $username = $_POST['user_name'];
    $email = $_POST['user_email'];

    $q = "UPDATE users SET user_name='$username' , user_email='$email' where user_id='$id'";
    mysqli_query($conn, $q);

    header('location:welcome.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update data</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="tittle4">
        <h2>ID:<?php echo $row['user_id'] ?></h2>
    </div>
    <div class="box4"></div>
    <div class="container4">

        <form method="POST">
            <label><b>New Username</b></label>
            <br />
            <input class="txtfield4" value="<?php echo $row['user_name'] ?>" class="txtfield3" type="text" name="user_name" />
            <i class="bx bx-user"></i>
            <br />
            <br />
            <br />
            <label><b>New Email</b></label>
            <br />
            <input class="txtfield4" value="<?php echo $row['user_email'] ?>" class="txtfield3" type="email" name="user_email" />
            <i class="bx bx-envelope"></i>
            <br>
            <button type="submit" class="site-btn3" name="btn_update">SUBMIT</button>
            <div class="rsth">
                <span>Dont want Update?</span>
            </div>
            <a class="rsthcancel" href="welcome.php" role="button">Cancel it</a>
        </form>
    </div>
    <img src="css/pictures/blue-purple galaxy.png" alt="">
</body>

</html>