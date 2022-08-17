<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>

<body>
    <div class="container">
        <div>
        <button><a href="cat-list.php">Category List</a></button><br><br>
        </div>
        <form action="includes/cat-add.inc.php" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title"></br>
            <label for="remark">Remark</label>
            <input type="text" name="remark" id="remark"><br>

            <input type="submit" name="submit" value="Add Category">
        </form>
    </div>

</body>

</html>