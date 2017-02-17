<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Artist</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<h1>Select an Artist</h1>
<form method="post" action="artist-details.php">
    <label for="artist">Artist:</label>
    <select name="artist" id="artist">
        <?php
            //read the db.ini file to get the credentials
            $db_array = parse_ini_file("database.ini");

            //build the connection with the credentials from the db.ini file
            $connection = new PDO('mysql:host='.$db_array["host"].';dbname='.$db_array["dbname"],
                ''.$db_array["username"], $db_array["password"]);

            //sql query to select the albums
            $sql = "SELECT artist FROM albums GROUP BY artist ORDER BY artist ;";

            //execute the query and store results
            $cmd = $connection->prepare($sql);
            $cmd->execute();
            $artists = $cmd->fetchAll();

            // loop through data
            foreach ($artists as $artist) {
                // adding each artist to the dropdown
                echo '<option value="' . $artist['artist'] . '">' . $artist['artist'] . '</option>';
            }
        ?>


    </select>
    <button class="btn btn-success">Go!</button>

</form>


<!-- Latest   jQuery -->
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>