<?php
require __DIR__ . "/classes/Database.php";

$connection = (new Database())->connectionDB();

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

$sql = "SELECT *
        FROM user
        WHERE reset_token_hash = :token_hash";

$stmt = $connection->prepare($sql);
$stmt->bindParam(":token_hash", $token_hash, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

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
        SET password = :password_hash,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = :user_id";

$stmt = $connection->prepare($sql);

$stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
$stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);
$stmt->execute();

echo "Heslo bylo změněno.";