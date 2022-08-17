<?php
session_start();
$uid = $_SESSION['uid'];

// connect with database
require('./admin/confs/config.php');
if (isset($_SESSION['uemail']) && isset($_SESSION['uid'])) {
    $point = 10;
    $add_point_sql = "INSERT INTO points (point,user_id, created_at, updated_at) VALUES ('$point','$uid', now(), now());";
    if (mysqli_query($conn, $add_point_sql)) {
        echo "already have been add point to your account!";
        $sql = "SELECT * FROM users INNER JOIN points ON users.id = {$uid} AND users.id = points.user_id;";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        $friSql = "SELECT friends.email FROM users INNER JOIN friends ON users.id = {$uid} AND users.id = friends.user_id;";
        $res = mysqli_query($conn, $friSql);

        $friResults = mysqli_fetch_all($res, MYSQLI_ASSOC);

        mysqli_free_result($result);
        mysqli_close($conn);
    } else {
        header("Location: profile.php?error=sqlerror");
        exit();
    }
} else {

    $sql = "SELECT * FROM users INNER JOIN points ON users.id = {$uid} AND users.id = points.user_id;";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);


    $friSql = "SELECT friends.email FROM users INNER JOIN friends ON users.id = {$uid} AND users.id = friends.user_id;";
    $res = mysqli_query($conn, $friSql);

    $friResults = mysqli_fetch_all($res, MYSQLI_ASSOC);

    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style type="text/css">
        .profile {
            width: 180px;
            height: auto;
        }

        img {
            width: 180px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <button><a href="index.php">Back</a></button><br><br>
        <div class="profile">
            <img src="admin/images/profile-images/<?php echo $row['profile']; ?>"><br><br>
        </div>
        <ul>
            <li>Name : <?php echo $row['name']; ?></li>
            <li>Email :<?php echo $row['email']; ?></li>
            <li>Your points: <?php echo $row['point']; ?> points</li>
            <p>Offered Lists: </p>
            <?php if (isset($friResults)) : ?>
                <?php foreach ($friResults as $friResult) : ?>
                    <li><?php echo $friResult['email']; ?></li>
                <?php endforeach ?>
            <?php else :
                echo "doesnot have offered friends";
            ?>
            <?php endif ?>

        </ul>
    </div>
</body>

</html>