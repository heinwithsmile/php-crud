<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <form action="includes/login.inc.php" method="post" style="width:300px; height:200px;">
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" name="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="login_submit">Submit</button>
        </form>
        <br>
        <a href="register.php"><button class="btn btn-primary">Register</button></a>
    </div>
</body>

</html>