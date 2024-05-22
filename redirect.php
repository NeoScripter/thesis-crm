<?php

session_start();
if (!isset($_SESSION['display_signup'])) {
    $_SESSION['display_signup'] = true;
}

if ($_SESSION['display_signup'] === true) {
    $switch_btn = 'Для клиентов';
    $_SESSION['display_signup'] = false;
} else {
    $switch_btn = 'Для заказчиков';
    $_SESSION['display_signup'] = true;
}

header("location: index.php");