<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Titles</title>
</head>
<body>

<?php
    //read the db.ini file to get the credentials
    $db_array = parse_ini_file("database.ini");

    //build the connection with the credentials from the db.ini file
    $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
        ''.$db_array["username"], $db_array["password"]);

    //sql query to select the album title
    $sql = "SELECT title FROM albums;";

    //execute the query and store results
    $cmd = $connection->prepare($sql);
    $cmd->execute();
    $albums = $cmd->fetchAll();


    //loop through the data
    foreach($albums as $album) {
        echo $album['title'].'<br />';
    }
    //disconnect
    $connection = null;
?>

</body>
</html>