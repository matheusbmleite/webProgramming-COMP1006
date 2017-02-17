<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Details</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<?php

    $albumId = null;
    $title = null;
    $year = null;
    $artist = null;

    //checking the url for an albumId, in case the user clicked the edit button
    if(!empty($_GET['albumId'])) {
        if(is_numeric($_GET['albumId'])) {
            $albumId = $_GET['albumId'];

            //read the db.ini file to get the credentials
            $db_array = parse_ini_file("database.ini");

            //build the connection with the credentials from the db.ini file
            $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                ''.$db_array["username"], $db_array["password"]);

            $sql = "SELECT title, launchYear, artist FROM albums WHERE albumId=:albumId;";
            $cmd = $connection->prepare($sql);
            $cmd->bindParam(':albumId', $albumId, PDO::PARAM_INT);
            $cmd->execute();
            $album = $cmd->fetch();

            $title = $album['title'];
            $year = $album['launchYear'];
            $artist = $album['artist'];

            $connection = null;

        }
    }

?>

<main class="container">
    <h1>Album Details</h1>
    <a href="albums.php">View Albums</a>
    <form method="post" action="save-album.php">
        <fieldset class="form-group">
            <label for="title" class="col-sm-1">Title: *</label>
            <input name="title" id="title" required placeholder="Album title" value="<?php echo $title; ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="launchYear" class="col-sm-1">Year: </label>
            <input name="launchYear" id="launchYear" type="number" required placeholder="Release Year" value="<?php echo $year; ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="artist" class="col-sm-1">Artist: *</label>
            <input name="artist" id="artist" required placeholder="Artist Name" value="<?php echo $artist; ?>"/>
        </fieldset>
        <input name="albumId" id="'albumId" value="<?php echo $albumId; ?>" type="hidden"/>
        <button class="btn btn-success col-sm-offset-1">Save</button>
    </form>
</main>
<!-- Latest   jQuery -->
<script src="js/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>