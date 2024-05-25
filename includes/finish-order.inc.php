<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include "../classes/dbh.classes.php";
    $dbHandler = new DbhHandler();
    
    $order_ids = $_POST['order_ids'];
    $finished_statuses = $_POST['finished_statuses'];
    
    foreach ($order_ids as $index => $order_id) {
        $is_order_finished = $finished_statuses[$index];
        $dbHandler->finishOrder($is_order_finished, $order_id);
    }
    
    header("location: ../account.php");
    exit;
} else {
    header("location: ../index.php");
    exit;
}