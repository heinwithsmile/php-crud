<?php
session_start();

if (isset($_POST['register_submit'])) { // evoke submit event ?

    require('../admin/confs/config.php'); // open connection with database

    // get form input data
    $username = $_POST['username'];
    $email = $_POST['mail'];
    $password = $_POST['password'];

    $file = $_FILES['avatar'];
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    //split file extension
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    // form validation 
    if (empty($username) || empty($email) || empty($password || empty($file))) {
        header("location: ../register.php?error=emptyFields");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$", $username)) {
        header("location: ../register.php?error=invalidmail and username");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../register.php?error=invalidmail");
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("location: ../register.php?error=invalidusername");
        exit();
    } else {
        $query = "SELECT * FROM users WHERE name = ? OR email = ?;";  // query or statement
        $stmt = mysqli_stmt_init($conn); // initialize prepare statement.....
        //prepare a sql statement for execution 
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result_check = mysqli_stmt_num_rows($stmt);
            if ($result_check > 0) {
                header("Location: ../register.php?error=usertaken");
                exit();
            } else {
                $insertQuery = "INSERT INTO users (name, email, profile, password) VALUES (?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $insertQuery)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    if (in_array($fileActualExt, $allowed)) {
                        if ($fileError === 0) {
                            if ($fileSize <= 1500000) {
                                $newFileName = uniqid("", true) . '.' . $fileActualExt;
                                $fileDestination = '../admin/images/profile-images/' . $newFileName;
                                if (move_uploaded_file($fileTmp, $fileDestination)) {
                                    mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $newFileName, $hashedPwd);
                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_close($stmt);
                                        $_SESSION['uemail'] = $email;
                                        if (isset($_POST['uid'])) {
                                            $uid = $_POST['uid'];
                                            $get_point_sql = "SELECT point FROM points WHERE user_id = {$uid};";
                                            $res_points = mysqli_query($conn, $get_point_sql);
                                            if ($points = mysqli_fetch_assoc($res_points)) {
                                                $point_plus = $points['point'] + 10;
                                                $add_point_sql = "UPDATE points SET point = '$point_plus', user_id = '$uid', updated_at = now() WHERE user_id = {$uid};";
                                                if (mysqli_query($conn, $add_point_sql)) {
                                                    mysqli_close($conn);
                                                    header("Location: ../login.php?Success");
                                                    exit();
                                                } else {
                                                    header("Location: ../login.php?error= <?php mysqli_errno($conn); ?>");
                                                    exit();
                                                }
                                            } else {
                                                header("Location: ../login.php?Success");
                                                exit();
                                            }
                                        } else {
                                            header("Location: ../login.php?Success");
                                            exit();
                                        }
                                    } else {
                                        header("Location: ../register.php?error=sqlerror");
                                        exit();
                                    }
                                } else {
                                    echo "upload error!";
                                }
                            } else {
                                echo 'Your file is too big!';
                            }
                        } else {
                            echo 'There was an error of your uploading file';
                        }
                    } else {
                        echo 'You cannot upload files of this type!';
                    }
                }
            }
        }
    }
    mysqli_close($conn);
} else {
    header("Location: ../register.php");
    exit();
}
