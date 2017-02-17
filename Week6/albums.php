<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<h1>Albums</h1>
<?php
    //access current session
    session_start();
    if(!empty($_SESSION['userId'])) {
        echo '<a href="album-details.php">Add a New Album</a>';
    }

    //read the db.ini file to get the credentials
    $db_array = parse_ini_file("database.ini");

    //build the connection with the credentials from the db.ini file
    $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
        ''.$db_array["username"], $db_array["password"]);

    //sql query to select the albums
    $sql = "SELECT albumId, title, launchYear, artist FROM albums ORDER BY title;";

    //execute the query and store results
    $cmd = $connection->prepare($sql);
    $cmd->execute();
    $albums = $cmd->fetchAll();

    // start table and headings
    echo '<table class="table table-striped table-hover"><tr><th>Title</th><th>Year</th><th>Artist</th>';

    if(!empty($_SESSION['userId'])) {
        echo '<th>Edit</th><th>Delete</th></tr>';
    }


    // loop through data
    foreach ($albums as $album) {
        // print each album as a new row
        echo '<tr><td>' . $album['title'] . '</td>
            <td>' . $album['launchYear'] . '</td>
            <td>' . $album['artist'] . '</td>';
        if(!empty($_SESSION['userId'])) {
            echo '<td><a href="album-details.php?albumId='. $album['albumId']. '" class="btn btn-primary">Edit</a></td>
            <td><a href="delete-album.php?albumId=' . $album['albumId'] . '" class="btn btn-danger confirmation">Delete</a></td></tr>';
        }
    }

    // end table
    echo '</table>';

    //disconnect
    $connection = null;

?>

<!-- Latest   jQuery -->
<script src="js/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!--Custom js-->
<script src="js/app.js"></script>
</body>
</html>
<?php ob_flush(); ?>