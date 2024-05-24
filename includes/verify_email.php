<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST["code"];

    session_start();
    $confirmation_code = $_SESSION['cnf-code'];
    unset($_SESSION['cnf-code']);
    unset($_SESSION["under-verification"]);

    if ($confirmation_code == $code) {
        $_SESSION["code-verified"] = true;
        header("location: ../client_order.php");
        exit;    
    } else {
        $_SESSION["email_errors"] = 'Неправильно указан код!';
        header("location: ../index.php");
        exit;    
    }
} else {
    header("location: ../index.php");
    exit;
}