<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['display_signup'])) {
        $_SESSION['display_signup'] = true;
    }
    
    if ($_SESSION['display_signup'] === true) {
        $_SESSION['display_signup'] = false;
    } else {
        $_SESSION['display_signup'] = true;
    }
    
    header("location: ../index.php");
    exit;
} else {
    header("location: ../index.php");
    exit;
}