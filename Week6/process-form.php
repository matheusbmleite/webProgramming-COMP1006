<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Processing form...</title>
</head>
<body>
<?php
//create 2 variables and store 2 form inputs in them
$name = $_POST['name'];
$email = $_POST['email'];

//display the variables
echo 'Name: ' . $name . '<br />';
echo 'Email: ' . $email . '<br />';
?>
</body>
</html>