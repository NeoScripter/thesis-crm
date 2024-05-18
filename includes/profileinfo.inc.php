<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    $id = $_SESSION["userid"];
    $uid = $_SESSION["useruid"];
    $firstName = htmlspecialchars($_POST["first-name"], ENT_QUOTES, "UTF-8");
    $lastName = htmlspecialchars($_POST["last-name"], ENT_QUOTES, "UTF-8");
    $patronymic = htmlspecialchars($_POST["patronymic"], ENT_QUOTES, "UTF-8");

    $fileTmpPath = $_FILES['profile-picture']['tmp_name'];
    $fileName = $_FILES['profile-picture']['name'];
    $fileSize = $_FILES['profile-picture']['size'];
    $fileType = $_FILES['profile-picture']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Sanitize file name
    $newProfilePicture = bin2hex(random_bytes(16)) . '.' . $fileExtension;

    // Directory in which the uploaded file will be moved
    $uploadFileDir = '../uploads/profile-pics/';
    if (!is_dir($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    $dest_path = $uploadFileDir . $newProfilePicture;
    $path = 'uploads/profile-pics/' . $newProfilePicture;

    move_uploaded_file($fileTmpPath, $dest_path);

    include "../classes/dbh.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";

    $profileInfo = new ProfileInfoContr($id, $uid);

    $profileInfo->updateProfileInfo($firstName, $lastName, $patronymic, $path);

    header("location: ../account.php");
}