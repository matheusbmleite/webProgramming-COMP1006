<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<main class="container">
    <h1>Log In</h1>
<?php
    $invalid = $_GET['invalid'];

    if($invalid) {
        echo '<div class="alert alert-danger" id="message">Invalid login</div>';
    } else {
        echo '<div class="alert alert-info" id="message">Please log in your account</div>';
    }
?>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" required />
        </fieldset>
        <fieldset class="col-sm-offset-2">
            <button class="btn btn-success">Login</button>
        </fieldset>
    </form>
</main>

<!-- Latest jQuery -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- custom js -->
<script src="js/app.js"></script>

</body>
</html>

