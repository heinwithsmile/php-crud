<?php
session_start();
// connect db
require_once('./admin/confs/config.php');

//check submit
if (isset($_POST['submit'])) {
    //get form data
    $email = mysqli_escape_string($conn, $_POST['email']);

    if (empty($email)) {
        header("Location: invite.php?error=empty fields");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: invite.php?error=invalid email");
        exit();
    } else {
        $uid = $_SESSION['uid'];
        $sql = "INSERT INTO friends(user_id, email, created_at, updated_at) VALUES('$uid','$email', now(), now());";

        if (mysqli_query($conn, $sql)) {
            header("Location: profile.php?success invite");
            exit();
        } else {
            header("Location: invite.php?error=sqlerror");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invite Friend</title>
</head>

<body>
    <div>
        <button class=""><a href="index.php">Back</a></button><br><br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="type email that you want to offer">
            <input type="submit" value="Invite" name="submit">
        </form>
    </div>
</body>

</html>