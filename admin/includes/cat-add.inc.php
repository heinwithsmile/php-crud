<?php
require('../confs/config.php');

if (isset($_POST['submit'])) {
    //get form fields
    $title = $_POST['title'];
    $remark = $_POST['remark'];

    if (empty($title) || empty($remark)) {
        header("Location: ../cat-add.php?error:empty fields!");
        exit();
    } else {
        $query = "INSERT INTO categories(title, remark, created_date, updated_date) VALUES('$title', '$remark', now(), now())";
        if (mysqli_query($conn, $query)) {
            header("Location: ../cat-list.php?Success");
            exit();
        } else {
            echo 'Error:' . mysqli_errno($conn);
        }
    }
}
