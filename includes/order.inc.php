<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include "../classes/dbh.classes.php";
    $database = new DbhHandler();

    if (isset($_POST['submitBtn'])) {
        echo "button submission works!";
    } else {
        $_SESSION["code-verified"] = true;
        $_SESSION["material"] = $_POST['material'];
        header("location: ../client_order.php");
        exit;
    }
} else {
    header("location: ../index.php");
    exit;
}