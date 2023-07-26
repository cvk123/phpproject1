<?php 

require "../assets/database.php";
require "../assets/url.php";
require "../assets/user.php";

session_start();

if($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	$conn = connectionDB();
	
		$log_email = $_POST["login-email"];
		$log_password = $_POST["login-password"];
		
		

		if (authentication($conn, $log_email, $log_password)){
			$id = getUserId($conn, $log_email); 

			session_regenerate_id(true);
			$_SESSION["is_logged_in"] = true;
			$_SESSION["logged_in_user"] = $id;
			redirectUrl("/skola-project/admin/zaci.php");
			
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