<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["userid"];
    $uid = $_SESSION["useruid"];
    $firstName = htmlspecialchars($_POST["first-name"], ENT_QUOTES, "UTF-8");
    $lastName = htmlspecialchars($_POST["last-name"], ENT_QUOTES, "UTF-8");
    $patronymic = htmlspecialchars($_POST["patronymic"], ENT_QUOTES, "UTF-8");
    $material = htmlspecialchars($_POST["material"], ENT_QUOTES, "UTF-8");
    
    if (strtolower($material) != 'металл' && strtolower($material) != 'дерево') {
        $material = 'металл';
    }

    $path;
    if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile-picture']['tmp_name'];
        $fileName = $_FILES['profile-picture']['name'];
    
        $uploadFileDir = '../uploads/profile-pics/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }
    
        $dest_path = $uploadFileDir . $fileName;

        if (!file_exists($dest_path)) {
            move_uploaded_file($fileTmpPath, $dest_path);
        }
        $path = 'uploads/profile-pics/' . $fileName;
    } else {
        $path = 'assets/images/' . 'default-avatar.png';
    }

    include "../classes/dbh.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";

    $profileInfo = new ProfileInfoContr($id, $uid);

    $profileInfo->updateProfileInfo($firstName, $lastName, $patronymic, $path, $material);

    header("location: ../account.php");
}