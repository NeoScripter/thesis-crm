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
    <div class="account-outer-wrapper">
        <div class="profile-wrapper">
            <div class="profile-header">
                <div class="header-username"><?php echo 'Привет, ' . $_SESSION["useruid"]; ?></div>
                <a href="includes/logout.inc.php" class="header-logout">Выйти</a>
            </div>
            <div class="profile-info">
                <div class="top">
                    <a href="profilesettings.php" class="profile-settings">Настройки</a>
                </div>
                <div class="user-info">
                    <div class="profile-img-wrapper"><img class="profile-img" src="<?php
                            $profileInfo->fetchPicture($_SESSION["userid"]);
                            ?>" alt="Profile Picture">
                    </div>
                    <ul class="account-info-ul">
                        <li class="account-info-li">
                            <?php
                            $profileInfo->fetchLastName($_SESSION["userid"]);
                            ?>
                        </li>
                        <li class="account-info-li">
                            <?php
                            $profileInfo->fetchFirstName($_SESSION["userid"]);
                            ?>
                        </li>
                        <li class="account-info-li">
                            <?php
                            $profileInfo->fetchPatronymic($_SESSION["userid"]);
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="specialty">Специализация: <?php 
                    echo $profileInfo->fetchMaterial($_SESSION["userid"]); 
                    ?>
                </div>
                <div class="account-switch orders">
                    <img src="assets/images/orders.svg" alt="orders"> Заказы
                </div>
                <div class="account-switch resources">
                    <img src="assets/images/resorces.svg" alt="resources"> Ресурсы
                </div>
                <div class="account-switch report">
                    <img src="assets/images/printer.svg" alt="report"> Отчет
                </div>
            </div>
            <div class="profile-orders">
                <div class="profile-order-row">
                    <div>1 Lorem ipsum dolor. ipsam dolores modi, expedita fuga saepe alias fugit nam dolorum quam impedit voluptatum sit error.</div>
                    <div>sit amet consectetur adipisicing elit</div>
                    <div>sit amet consectetur adipisicing elit</div>
                    <div>Excepturi commodi, nobis neque architecto ea illum</div>
                    <div>2</div>
                    <div>2</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>