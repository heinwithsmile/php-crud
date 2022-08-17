<?PHP
require('./confs/config.php');
$id = $_GET['id'];
$getCat = "SELECT * FROM categories WHERE id = {$id};";

$result = mysqli_query($conn, $getCat);

$row = mysqli_fetch_assoc($result);

//check submit
if (isset($_POST['submit'])) {
    //get form fields
    $uid = $_POST['uid'];
    $title = $_POST['title'];
    $remark = $_POST['remark'];

    if (empty($title) || empty($remark)) {
        header("Location: cat-edit.php?error:empty fields!");
        exit();
    } else {
        $query = "UPDATE categories SET title='$title', remark='$remark', updated_date = now() WHERE id = {$uid};";
        mysqli_query($conn, $query);
        header("Location: cat-list.php?Success");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>

<body>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo $row['title']; ?> "></br>
        <label for="remark">Remark</label>
        <input type="text" name="remark" id="remark" value="<?php echo $row['remark']; ?>"><br>
        <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
        <input type="submit" name="submit" value="Update Category">
    </form>

</body>

</html>