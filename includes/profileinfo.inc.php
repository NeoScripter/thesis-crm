<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["userid"];
    $uid = $_SESSION["useruid"];
    $firstName = htmlspecialchars($_POST["first-name"], ENT_QUOTES, "UTF-8");
    $lastName = htmlspecialchars($_POST["last-name"], ENT_QUOTES, "UTF-8");
    $patronymic = htmlspecialchars($_POST["patronymic"], ENT_QUOTES, "UTF-8");

    include "../classes/dbh.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";

    $profileInfo = new ProfileInfoContr($id, $uid);

    $profileInfo->updateProfileInfo($firstName, $lastName, $patronymic);

    header("location: ../account.php");
}