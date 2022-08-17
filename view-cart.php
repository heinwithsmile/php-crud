<?php
session_start();
if (!isset($_SESSION['cart'])) {
    header("location: index.php?error=empty cart");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <table>
            <tr>
                <th>Subject Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Price</th>
            </tr>
            <?php
            require('admin/confs/config.php');
            $total = 0.0;
            foreach ($_SESSION['cart'] as $id => $qty) :
                $query = "SELECT * FROM subjects WHERE category_id = {$id};";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total += $row['price'] * $qty;
            ?>
                <tr>
                    <td><?php echo $row['subj_name']; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['price'] * $qty; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" align="right"><b>Total : </b></td>
                <td>$ <?php echo $total; ?></td>
            </tr>
        </table>
        <div class="order-form">
            <form action="submit-order.php" method="POST">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name"><br>

                <label for="email">Email</label>
                <input type="email" name="email" id="email"><br>

                <label for="address">Address</label>
                <input type="text" name="address" id="address"><br>

                <input type="submit" value="Submit Order" name="submit">
            </form><br><br>
        </div>
        <button><a href="clear-cart.php">Clear Cart</a></button>
    </div>
</body>

</html>