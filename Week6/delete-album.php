<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Album...</title>
</head>
<body>
<?php
    //get the albumId from the URL, and checking if it has a numeric value
    $albumId = $_GET["albumId"];
    if(!empty($albumId)) {
        if(is_numeric($albumId)) {


            $db_array = parse_ini_file("database.ini");

            $connection = new PDO('mysql:host='. $db_array["host"] . ';dbname=' . $db_array["dbname"], $db_array["username"],
            $db_array["password"]);

            $sql = "DELETE FROM albums WHERE albumId = :albumId;";

            $cmd = $connection->prepare($sql);
            $cmd->bindParam(':albumId', $albumId, PDO::PARAM_INT);
            $cmd->execute();

            $connection = null;
        }
    }

//    redirecting the user to another page
    header('location:albums.php');
?>
</body>
</html>
<?php ob_flush(); ?>