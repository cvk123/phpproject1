<?php

/**
 * 
 * Recaptcha Ověření uživatele
 * 
 * @param string $response - reCAPTCHA odpověď
 * 
 * @return bool - true, pokud ověření reCAPTCHA bylo úspěšné, false, pokud ověření selhalo
 * 
 */
function verifyRecaptcha($response) {

    $recaptchaSecretKey = '6Lc-aTInAAAAAFwHQloXyk6y2PPAE_IeEabP2Qxp';

    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaData = [
        'secret' => $recaptchaSecretKey,
        'response' => $response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $recaptchaOptions = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($recaptchaData)
        ]
    ];

    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
    $recaptchaResult = json_decode($recaptchaResult);

    if (!$recaptchaResult->success) {
        return false;
    }

    return true;
}

?>

