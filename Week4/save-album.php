<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album</title>
</head>
<body>

<?php

    //read the db.ini file to get the credentials
    $db_array = parse_ini_file("database.ini");

    //store the form inputs into variables
    $title = $_POST['title'];
    $launchYear = $_POST['launchYear'];
    $artist = $_POST['artist'];
//    variable to indicate if there are 1 or more errors
    $ok = true;

    // validating the inputs before saving
    if(empty($title)) {
        echo 'Title is required<br />';
        $ok = false;
    }
    if(empty($artist)) {
        echo 'Artist is required<br />';
        $ok = false;
    }
    if(!empty($launchYear)) {
        if($launchYear < 1900) {
            echo 'Year must be 1900 or greater';
            $ok = false;
        } else {
            //converting to an integer
            $launchYear = intval($launchYear);
        }
    }

    if($ok) {
        //build the connection with the credentials from the db.ini file
        $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
            ''.$db_array["username"], $db_array["password"]);

        //set up an SQL instruction to save the new album
        $sql = "INSERT INTO albums(title, launchYear, artist) VALUES (:title, :launchYear, :artist);";

        //pass the input variable to the SQL command
        $cmd = $connection->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->bindParam(':launchYear', $launchYear, PDO::PARAM_INT);
        $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);

        //execute the INSERT
        $cmd->execute();

        //disconnect
        $connection = null;

        //show a message to the user
        echo 'Your Album was saved successfully!';
    }
?>

</body>
</html>