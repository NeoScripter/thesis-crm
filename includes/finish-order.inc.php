<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include "../classes/dbh.classes.php";
    $dbHandler = new DbhHandler();
    
    $order_id = $_POST['order-id'];
    $is_order_finished = $_POST['finished'];
    
    $dbHandler->finishOrder($is_order_finished, $order_id);
    
    header("location: ../account.php");
    exit;
} else {
    header("location: ../index.php");
    exit;
}