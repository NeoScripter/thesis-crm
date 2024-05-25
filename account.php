<?php 
    session_start();
    include "classes/dbh.classes.php";
    include "classes/profileinfo.classes.php";
    include "classes/profileinfo-view.classes.php";
    include "classes/order.classes.php";

    $profileInfo = new ProfileInfoView();
    $orderInfo = new OrderInfo();
    $profileId = $profileInfo->fetchId($_SESSION["userid"]);
    $orders = $orderInfo->getOrderInfo($profileId);
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
                    <div>Имя</div>
                    <div>Телефон</div>
                    <div>Название изделие</div>
                    <div>Чертеж</div>
                    <div>Комментарий</div>
                    <div>Выполнен</div>
                </div>
                <form class="profile-order-row" action="includes/finish-order.inc.php" method="post">
                    <?php 
                    foreach($orders as $order) {
                        $notFinished = ($order['finished'] == "Нет") ? "selected" : "";
                        $finished = ($order['finished'] == "Нет") ? "" : "selected";
                        echo '<div>' . $order['username'] . '</div>';
                        echo '<input type="hidden" name="order-id" value="' . $order['order_id'] . '">';
                        echo '<div>' . $order['phone'] . '</div>';
                        echo '<div>' . $order['item_description'] . '</div>';
                        echo '<div class="image-expandable">' . '<img src="' . $order["item_image"] . '" alt="drawing" class="order-drawing">' . '</div>';
                        echo '<div>' . $order['item_comment'] . '</div>';
                        echo '<select name="finished" class="finished-select" onchange="submitForm()">
                        <option value="Нет" ' . $notFinished . '>Нет</option>
                        <option value="Да" ' . $finished . '>Да</option>
                        </select>';
                    }
                    ;?>
                </form>
            </div>
        </div>
    </div>
    <script>
    const selectElements = document.querySelectorAll('.finished-select');
    
    selectElements.forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            const form = selectElement.closest('form');
            if (form) {
                form.submit();
            }
        });
    });
    </script>
</body>
</html>