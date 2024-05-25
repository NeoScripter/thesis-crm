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

    $current_display = 'orders';
    if (isset($_SESSION['orders-switch'])) {
        $current_display = $_SESSION['orders-switch'];
    }
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
                <form class="account-switch orders" action="includes/account-switch.inc.php" method="post">
                    <button name="orders-switch"><img src="assets/images/orders.svg" alt="orders"> Заказы</button>
                </form>
                <form class="account-switch resources" action="includes/account-switch.inc.php" method="post">
                    <button name="resources-switch"><img src="assets/images/resorces.svg" alt="resources"> Ресурсы</button>
                </form>
                <form class="account-switch report" action="includes/account-switch.inc.php" method="post">
                    <button name="report-switch"><img src="assets/images/printer.svg" alt="report"> Отчет</button>
                </form>
            </div>
            <div class="profile-display">
                <div class="profile-orders" style="display: <?php echo ($current_display == 'orders') ? 'block' : 'none' ;?>">
                    <div class="profile-order-row">
                        <div>Имя</div>
                        <div>Телефон</div>
                        <div>Название изделия</div>
                        <div>Чертеж</div>
                        <div>Комментарий</div>
                        <div>Выполнен</div>
                    </div>
                    <form class="profile-order-row" action="includes/finish-order.inc.php" method="post">
                    <?php foreach($orders as $order): ?>
                        <div><?php echo $order['username']; ?></div>
                        <input type="hidden" name="order_ids[]" value="<?php echo $order['order_id']; ?>">
                        <div><?php echo $order['phone']; ?></div>
                        <div><?php echo $order['item_description']; ?></div>
                        <div class="image-expandable">
                            <img src="<?php echo $order["item_image"]; ?>" alt="drawing" class="order-drawing">
                        </div>
                        <div><?php echo $order['item_comment']; ?></div>
                        <select name="finished_statuses[]" class="finished-select">
                            <option value="Нет" <?php echo ($order['finished'] == 'Нет') ? 'selected' : ''; ?>>Нет</option>
                            <option value="Да" <?php echo ($order['finished'] == 'Нет') ? '' : 'selected'; ?>>Да</option>
                        </select>
                    <?php endforeach; ?>
                    </form>
                </div>
                <div class="profile-resources" style="display: <?php echo ($current_display == 'resources') ? 'block' : 'none' ;?>">
                    <form action="includes/update-resrc.inc.php" class="src-content" method="post">
                        <div class="src-row">
                            <div class="src-name">Гвозди</div>
                            <div class="src-qnt">
                                <button name="add">+</button>
                                <div>100</div>
                                <button name="deduct">-</button>
                            </div>
                            <button name="remove">Удалить</button>
                        </div>
                    </form>
                </div>
                <div class="profile-report" style="display: <?php echo ($current_display == 'report') ? 'block' : 'none' ;?>">
                    This is the report page!
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.finished-select');
        selects.forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });
    });
    </script>
</body>
</html>