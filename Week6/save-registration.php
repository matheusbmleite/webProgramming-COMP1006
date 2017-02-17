<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Registration</title>
</head>
<body>

<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $ok = true;

    //verifying the data
    if(empty($username)) {
        echo 'Username is requiered <br />';
        $ok = false;
    }

    if(empty($password) || strlen($password) < 8) {
        echo 'Password is invalid <br />';
        $ok = false;
    }

    if($password != $confirm) {
        echo 'Password do not match <br />';
        $ok = false;
    }

    if($ok) {
        //read the db.ini file to get the credentials
        $db_array = parse_ini_file("database.ini");

        //build the connection with the credentials from the db.ini file
        $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
            ''.$db_array["username"], $db_array["password"]);

        $sql = 'INSERT INTO users(username, password) VALUES (:username, :password);';

        //hashing the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();
        $connection = null;

        echo 'Registration saved. Click <a href="login.php">Login</a>';

    }




?>

</body>
</html>