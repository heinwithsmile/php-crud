<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Register Form</title>
    <style>
        body {
            font: 14px sans-serif;
        }

        .container {
            width: 400px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-success">Please Register Here</h3>
        <form action="includes/register.inc.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="uid" value="<?php echo $_GET['id']; ?>">
            <div class="form-group">
                <label for="username">UserName</label>
                <input type="text" class="form-control" name="username" placeholder="Type your Name">
            </div>
            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" class="form-control" name="mail" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" class="form-control" name="avatar" id="avatar">
            </div>
            <button type="submit" class="btn btn-primary" name="register_submit">Submit</button>
        </form>
        <br>
        <div>
            <a href="login.php"><button class="btn btn-primary">Login</button></a>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </div>

</body>

</html>