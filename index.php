<?php
session_start();
require('./admin/confs/config.php');

$sql = "SELECT * FROM categories;";

$result = mysqli_query($conn, $sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home</title>
</head>

<body>

    <?php if (isset($_SESSION['uid'])) : ?>
        <div class="container">
            <?php foreach ($rows as $row) : ?>
                <ul>
                    <li><a href="subject.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></li>
                </ul>
            <?php endforeach ?>
            <div>
                <button><a href="includes/logout.inc.php">Logout</a></button><br><br>
                <button><a href="profile.php">Profile</a></button><br><br>
                <button><a href="view-cart.php">View Cart</a></button><br><br>
                <button><a href="invite.php">Invite Friend</a></button><br><br>
            </div>
        </div>
    <?php else : ?>
        <button><a href="register.php">Register</a></button><br><br>
        <button><a href="login.php">Login</a></button><br><br>
    <?php endif ?>
</body>

</html>