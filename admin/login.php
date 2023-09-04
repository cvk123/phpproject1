<?php 

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";

session_start();

if($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	$connection = (new Database())->connectionDB();
	
		$log_email = $_POST["login-email"];
		$log_password = $_POST["login-password"];
		
		

		if (User::authentication($connection, $log_email, $log_password)){
			$id = User::getUserId($connection, $log_email); 

			session_regenerate_id(true);
			$_SESSION["is_logged_in"] = true;
			$_SESSION["logged_in_user"] = $id;
			URL::redirectUrl("/skola-project/admin/zaci.php");
			
		} else{
			$error = "Špatné přihlašovací údaje";	
			header("Location: /skola-project/signin.php");		
		}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php if(!empty($error)): ?>
    <p> <?= $error; ?> </p>
    <?php endif; ?>


</body>



</html>