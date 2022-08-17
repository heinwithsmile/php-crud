<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
</head>

<body>
    <div class="container">
        <h1>New Book</h1>
        <form action="includes/subj-add.inc.php" method="post" enctype="multipart/form-data">
            <label for="categories">Categories</label>
            <select name="cat_id" id="categories">
                <option value="0">---Choose---</option>
                <?php
                require('./confs/config.php');

                $sql = "SELECT id, title FROM categories;";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['title']; ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <label for="name">Subject Name</label>
            <input type="text" name="name" id="name"><br>
            <label for="Cover">Cover</label>
            <input type="file" name="cover" id="cover"><br>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="20" rows="10"></textarea><br>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" placeholder="$"><br>
            <input type="submit" value="Add Subject" name="submit">
        </form>
    </div>
</body>

</html>