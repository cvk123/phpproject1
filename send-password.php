<?php

use PHPMailer\PHPMailer\Exception;

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

require __DIR__ . "/classes/Database.php";

$db = (new Database())->connectionDB();

$sql = "UPDATE user
        SET reset_token_hash = :token_hash,
            reset_token_expires_at = :expiry
        WHERE email = :email";

$stmt = $db->prepare($sql);
$stmt->bindParam(":token_hash", $token_hash, PDO::PARAM_STR);
$stmt->bindParam(":expiry", $expiry, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("cvocek123456@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Resetování hesla";
    $mail->Body = "Pro resetování hesla klikněte na tento odkaz: <a href='http://localhost/skola-project/reset-password.php?token=$token'>Resetovat heslo</a>";

    try {
        $mail->send();
        echo "Zpráva odeslána. Zkontrolujte si email.";
    } catch (Exception $e) {
        echo "Email se nepodařilo odeslat. Chyba: {$mail->ErrorInfo}";
    }
}