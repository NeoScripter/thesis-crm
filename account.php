<?php 
    session_start();
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
    <div class="account-outer-wrapper">
        <div class="profile-wrapper">
            <div class="profile-header">
                <div class="header-username"><?php echo 'Привет, ' . $_SESSION["useruid"]; ?></div>
                <a href="includes/logout.inc.php" class="header-logout">Выйти</a>
            </div>
            <div class="profile-info">
                <div class="top">
                    <div class="profile-settings">Настройки</div>
                    <div class="profile-img-wrapper"><img src="assets/images/man-stock.jpeg" alt="Minion" class="profile-img"></div>
                </div>
                <ul>
                    <li>Фамилия</li>
                    <li>Имя</li>
                    <li>Отчество</li>
                </ul>
            </div>
            <div class="profile-orders">

            </div>
        </div>
    </div>
    <p class="login-success">Successful login!</p>
</body>