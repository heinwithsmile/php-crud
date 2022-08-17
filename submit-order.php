<?php
require('./admin/confs/config.php');
session_start();

if (!isset($_SESSION['cart'])) {
    header("location: index.php?error=empty cart");
    exit();
} elseif (isset($_POST['submit'])) {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $address = mysqli_escape_string($conn, $_POST['address']);

    $query = "INSERT INTO orders (user_name, email, address, created_date, updated_date) VALUES ('$name', '$email', '$address', now(), now());";
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($_SESSION['cart'] as $id => $qty) {
            mysqli_query($conn, "INSERT INTO order_items (subj_id, order_id, qty) VALUES ($id, $order_id, $qty);");
        }
        unset($_SESSION['cart']);
        header("location: index.php?Success Order Submit");
        exit();
    } else {
        header("location: index.php?error=sqlerror");
        exit();
    }
}
