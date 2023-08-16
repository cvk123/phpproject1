<?php
require __DIR__ . "/assets/database.php";

$mysqli = connectionDB();

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

$sql = "SELECT *
            FROM user
            WHERE reset_token_hash = ?";

$stmt = mysqli_prepare($mysqli, $sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Neplatný nebo chybějící token pro reset hesla.");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token pro reset hesla vypršel.");
}

if (strlen($_POST["password"]) < 5) {
    die("Heslo musí mít alespoň 5 znaků.");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Heslo musí obsahovat alespoň jednu číslici.");
}

if ($_POST["password"] !== $_POST["confirm_password"]) {
    die("Hesla se neshodují.");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE user
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = mysqli_prepare($mysqli, $sql);

$stmt->bind_param("si", $password_hash, $user["id"]);
$stmt->execute();

echo "Heslo bylo změněno.";
