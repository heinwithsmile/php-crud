<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Page</title>
    <style type="text/css">
        img {
            width: 180px;
            height: auto;
        }
    </style>
</head>

<body>
    <div>
        <?php
        require('admin/confs/config.php');
        $sql = "SELECT * FROM subjects INNER JOIN categories ON subjects.category_id = categories.id AND subjects.category_id = {$_GET['id']};";
        if ($result = mysqli_query($conn, $sql)) :
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($rows as $row) :
        ?>
                <div><img src="admin/images/<?php echo $row['cover']; ?>" alt="" srcset="" style="width: 300; height: auto;"></div><br>
                <h3><?php echo $row['subj_name']; ?></h3><br>
                <p><?php echo $row['subj_description']; ?></p><br>
                <p>$ <?php echo $row['price']; ?></p>
                <button><a href="add-to-cart.php?id=<?php echo $row['id']; ?>">Add to cart</a></button><br><br>
        <?php endforeach;
        else :
            echo "Error:" . mysqli_errno($conn);
        endif; ?>
    </div>
</body>

</html>