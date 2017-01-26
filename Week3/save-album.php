<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album</title>
</head>
<body>

<?php
    //store the form inputs into variables
    $title = $_POST['title'];
    $launchYear = $_POST['launchYear'];
    $artist = $_POST['artist'];

    // connect to the database - dbtype, server address, dbname, username, password
    $connection = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200350070', 'gc200350070', 'H9AFujyv');
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
?>

</body>
</html>