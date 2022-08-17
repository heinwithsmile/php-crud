<?php
require('confs/config.php');
$result = mysqli_query($conn, "SELECT * FROM order_items");
while ($rows = mysqli_fetch_assoc($result)) {
    print_r($rows);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>

<body>
    <div class="container">
        <h1>Orders</h1>
    </div>
</body>

</html>