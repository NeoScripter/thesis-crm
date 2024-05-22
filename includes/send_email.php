<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];

    session_start();
    require_once "webform_contr.inc.php";

    if (is_input_empty($email)) {
        $_SESSION['email_errors'] = 'Заполните указанное поле!';
        header("location: ../index.php");
        exit;
    }

    if (!is_email_valid($email)) {
        $_SESSION['email_errors'] = 'Неправильный email!';
        header("location: ../index.php");
        exit;
    }

    $confirmation_code = rand(100000, 999999);
    $_SESSION['cnf-code'] = $confirmation_code;
    $_SESSION["under-verification"] = true;
    // Email recipient and subject
    $to = $email;
    $subject = 'Код подтверждения';

    // Headers
    $headers = "From: donotreply@gmail.com\r\n";
    $headers .= "Reply-To: donotreply@gmail.com\r\n";
    $headers .= "Content-Type: text/plain;charset=utf-8\r\n";

    // Prepare the email body
    $message = "Никому не говорите данный код:\n\n";
    $message .= $confirmation_code;

    mail($to, $subject, $message, $headers);
    header("location: ../index.php");
    exit;

} else {
    header("location: ../index.php");
    exit;
}
?>
