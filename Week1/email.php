<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="UTF-8">
	<title>Sending an email</title>
</head>
<body>
<h1>Using a variable to send an email through php</h1>
<?php
$to = 'matheusbmleite@gmail.com';
$subject = 'sending email from php';
$message = 'Did this actually work?';
//$from = 'matheusbmleite@gmail.com';
//concat 'From' . $from
mail($to, $subject, $message);

echo 'Go check your email!';
?>
</body>
</html>