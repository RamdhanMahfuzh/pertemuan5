<?php
session_start();
include('server/connection.php');

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $q = "SELECT * FROM users WHERE user_id LIKE '%$keyword%' OR
    user_name LIKE '%$keyword%' OR  user_email LIKE '%$keyword%'";
} else {
    $q = 'SELECT * FROM users';
}

$result = mysqli_query($conn, $q);

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        header('location:login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/welcome1.css" type="text/css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tugas</title>
</head>

<body>
    <!-- <div class="card">
        <h1 class="judul">WELCOME</h1>
        <img class="foto" src="<?php echo $row['user_photo']; ?>" alt="">
        <h4><?php echo $row['user_name']; ?></h4>
        <h3 class="email"><?php echo $row['user_email']; ?></h3>
        <h4><?php echo $row['user_city']; ?></h4>
        <br>
        <a class="logout" href="welcome.php?logout=1" id="logout-btn" class="btn btn-danger">Log Out</a>
    </div> -->

    <div class="box3">
        <button class="btn--logout"><a class="btn-logout" href="welcome.php?logout=1" role="button">Log Out</a></button>
        <form class="search" method="post">
            <input class="search-box" type="text" name="keyword" placeholder="Masukan keyword">
            <br>
            <span>
                <button type="submit" class="btn-search" name="cari">Cari</button>
            </span>
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th colspan="2" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td align="center"><?php echo $row['user_id'] ?></td>
                        <td align="center"><?php echo $row['user_name'] ?></td>
                        <td align="center"><?php echo $row['user_email'] ?></td>
                        <td>
                            <button class="btn-delete"><a class="delete" href="actionDelete.php?user_id=<?php echo $row['user_id']; ?>" role="button" onclick="return confirm('Data ini akan dihapus')">Hapus</a></button>
                        </td>
                        <td>
                            <button class="btn-update"><a class="update" href="update.php?user_id=<?php echo $row['user_id']; ?>">Update</a></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>