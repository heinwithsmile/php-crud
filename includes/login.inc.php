<?php
session_start();
require('../admin/confs/config.php');
$username = $_POST['name'];
$email = $_POST['name'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    header("Location: ../login.php?error=emptyFields");
    exit();
} else {
    $sql = "SELECT * FROM users WHERE name = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $pwd = $row['password'];
            if (!password_verify($password, $pwd)) {
                header("Location: ../login.php?error=wrong password");
                exit();
            } else {
                $_SESSION['uid'] = $row['id'];
                header("Location: ../index.php?login=success");
                exit();
            }
        } else {
            header("Location: ../login.php?error=nouser");
            exit();
        }
    }
}
