<?php
require('./confs/config.php');

$sql = "SELECT * FROM categories;";

$result = mysqli_query($conn, $sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $del_id = $_POST['delete_id'];

    //query for delete 
    $query = "DELETE FROM categories WHERE id = {$del_id}";

    mysqli_query($conn, $query);
    mysqli_close($conn);
    header("Location: cat-list.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat List</title>
</head>

<body>
    <div class="container">
    <button><a href="index.php">Home</a></button><br><br>
        <?php foreach ($rows as $row) : ?>
            <ul>
                <li><a href="subj-list.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></li>
                <button><a href="cat-edit.php?id=<?php echo $row['id']; ?>">Edit</a></button><br><br>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Delete" class="" name="submit">
                </form>
            </ul>
        <?php endforeach ?>
        <button><a href="cat-add.php">New Category</a></button>
    </div>
</body>

</html>