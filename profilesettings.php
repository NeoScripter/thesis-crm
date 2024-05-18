<?php 
    session_start();
    include "classes/dbh.classes.php";
    include "classes/profileinfo.classes.php";
    include "classes/profileinfo-view.classes.php";

    $profileInfo = new ProfileInfoView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM system</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <section class="profile">
        <div class="profile-bg">
            <div class="profile-settings-wrapper">
                <h3>Настройки профиля</h3>
                <p>Заполните информацию о себе</p>
                <form action="includes/profileinfo.inc.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="last-name" placeholder="Фамилия" value="<?php $profileInfo->fetchLastName($_SESSION["userid"]);?>">
                    <input type="text" name="first-name" placeholder="Имя" value="<?php $profileInfo->fetchFirstName($_SESSION["userid"]);?>">
                    <input type="text" name="patronymic" placeholder="Отчество" value="<?php $profileInfo->fetchPatronymic($_SESSION["userid"]);?>">
                    <input type="file" name="profile-picture">
                    <button type="submit" name="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>