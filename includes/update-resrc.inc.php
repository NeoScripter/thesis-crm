<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include "../classes/dbh.classes.php";
    $dbHandler = new DbhHandler();

    $profile_id = $_POST['profile-id'];
    $current_qnts = $_POST['src_qnt'];
    $src_ids = $_POST['src_id'];
    $new_src = $_POST['new-src'];
    $new_src_qnt = $_POST['new-qnt'];

    foreach ($src_ids as $index => $src_id) {
        $current_qnt = $current_qnts[$index];
        $new_qnt = $current_qnt;

        if (isset($_POST['add'][$src_id])) {
            $new_qnt += 1;
        } elseif (isset($_POST['deduct'][$src_id])) {
            $new_qnt = ($new_qnt !== 0) ? $new_qnt - 1 : $new_qnt;
        } elseif (isset($_POST['remove'][$src_id])) {
            $dbHandler->deleteResource($src_id);
            continue;
        } elseif (isset($_POST['add-new'])) {
            $dbHandler->addResource($profile_id, $new_src, $new_src_qnt);
        }

        $dbHandler->updateResource($src_id, $new_qnt);
    }
    
    header("location: ../account.php");
    exit;
} else {
    header("location: ../index.php");
    exit;
}