<?php
require __DIR__ . "/classes/Database.php";

$connection = (new Database())->connectionDB();

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$sql = "SELECT *
        FROM user
        WHERE reset_token_hash = :token_hash";

$stmt = $connection->prepare($sql);
$stmt->bindValue(":token_hash", $token_hash, PDO::PARAM_STR);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result === false) {
    die("Neplatný nebo chybějící token pro reset hesla.");
}

if (strtotime($result["reset_token_expires_at"]) <= time()) {
    die("Token pro reset hesla vypršel.");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-querymain.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/resettpass.css">
    <link rel="cv icon" href="./img/logo.jpg" type="img">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Zapomenuté heslo</title>
</head>

<body>

    <h1>Resetování hesla</h1>
    <section class="add-form">
        <form method="POST" action="process-reset.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <div class="input-container">
                <label for="password">Nové heslo:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-container">
                <label for="confirm_password">Potvrzení hesla:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div>
                <button type="submit">Změnit heslo</button>
            </div>
        </form>
    </section>
</body>

</html>