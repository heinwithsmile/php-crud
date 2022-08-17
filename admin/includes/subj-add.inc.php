<?php
//connect db
require('../confs/config.php');

//check submit
if (isset($_POST['submit'])) {
    //get form data
    $cat_id = $_POST['cat_id'];
    $subj_name = $_POST['name'];
    $cover = $_FILES['cover'];
    $fileName = $cover['name'];
    $fileType = $cover['type'];
    $fileTmp = $cover['tmp_name'];
    $fileSize = $cover['size'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    //check fields
    if (empty($subj_name) || empty($description) || empty($cover)) {
        header("Location: ../subj-add.php?error=empty_fields");
        exit();
    } else {
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedType = array('jpg', 'png', 'jpeg');
        if (in_array($fileActualExt, $allowedType)) {
            if ($fileSize <= 1500000) {
                $fileDestination = '../images/' . $fileName;
                if (move_uploaded_file($fileTmp, $fileDestination)) {
                    $sql = "INSERT INTO subjects(category_id, subj_name, cover, subj_description, price, created_date, updated_date) VALUES('$cat_id', '$subj_name', '$fileName', '$description', '$price', now(), now())";
                    if (mysqli_query($conn, $sql)) {
                        header("Location: ../cat-list.php?Success");
                        exit();
                    } else {
                        echo "Error: " . mysqli_errno($conn);
                    }
                } else {
                    echo "cannot move file location";
                }
            } else {
                echo "file size is too big";
            }
        } else {
            echo "invalid file type";
        }
    }
}
