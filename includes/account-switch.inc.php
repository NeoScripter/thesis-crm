<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (isset($_POST['orders-switch'])) {
        $_SESSION['orders-switch'] = 'orders';
    } elseif (isset($_POST['resources-switch'])) {
        $_SESSION['orders-switch'] = 'resources';
    } elseif (isset($_POST['report-switch'])) {
        $_SESSION['orders-switch'] = 'report';
    }
    
    header("location: ../account.php");
    exit;
} else {
    header("location: ../index.php");
    exit;
}