<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (isset($_POST['submitBtn'])) {
        echo "button submission works!";
    } else {
        echo "selection submission works!";
    }
} else {
    header("location: ../index.php");
    exit;
}