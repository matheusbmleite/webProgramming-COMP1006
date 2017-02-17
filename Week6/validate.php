<?php ob_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    //read the db.ini file to get the credentials
    $db_array = parse_ini_file("database.ini");

    //build the connection with the credentials from the db.ini file
    $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
        ''.$db_array["username"], $db_array["password"]);


    $sql = "SELECT userId, password FROM users WHERE username = :username;";

    $cmd = $connection->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();

    $user = $cmd->fetch();

    $connection = null;

    if(password_verify($password, $user['password'])) {

        session_start(); //access to the existing session
        $_SESSION['userId'] = $user['userId']; //store the user's id in a session variable
        header('location:albums.php'); //redirecting the user


    } else {
        header('location:login.php?invalid=true');
        exit();
    }

ob_flush(); ?>