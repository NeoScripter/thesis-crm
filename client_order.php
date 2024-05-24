<?php

session_start();
if (!isset($_SESSION["code-verified"])) {
    header("location: index.php");
} 

if (!isset($_SESSION["material"])) {
    $_SESSION["material"] = 'металл';
}
include "classes/dbh.classes.php";
$database = new DbhHandler();

$material = $_SESSION["material"];
    
if (strtolower($material) != 'металл' && strtolower($material) != 'дерево') {
    $material = 'металл';
}
$workers = $database->getWorkersByMaterial($material);

;?>

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
            <div class="profile-settings-wrapper client-order">
                <a href="includes/logout.inc.php" class="svg-exit"><img src="assets/images/close.svg" alt="X"></a>
                <h3>Заказ</h3>
                <p>Заполните заявку на заказ</p>
                <form id="orderForm" action="includes/order.inc.php" method="post" enctype="multipart/form-data">
                    <label for="name">Введите ваше полное имя</label>
                    <input type="text" name="name" value="">
                    <label for="material">Выберите тип изделия</label>
                    <select name="material" onchange="submitForm()">
                        <option value="металл" <?php echo ($material == 'металл') ? 'selected' : ''; ?>>Металл</option>
                        <option value="дерево" <?php echo ($material == 'дерево') ? 'selected' : ''; ?>>Дерево</option>
                    </select>
                    <label for="item">Укажите название изделия</label>
                    <input type="text" name="item" value="">
                    <label for="drawing">Чертеж изделия</label>
                    <input type="file" name="drawing" placeholder="Чертеж">
                    <label for="worker">Выберите исполнителя</label>
                    <select name="worker">
                        <?php 
                        foreach($workers as $worker) {
                            echo '<option value="' . $worker['profiles_id'] . '">' . $worker['profiles_lastname'] . ' ' . $worker['profiles_firstname'] . ' ' . $worker['profiles_patronymic'] . '</option>';
                        }
                        ;?>
                    </select>
                    <label for="comment">Оставьте комментарий к заказу</label>
                    <textarea id="comment" name="comment" rows="2"></textarea>
                    <button type="submit" name="submitBtn">Отправить</button>
                </form>
                <script>
                    function submitForm() {
                        document.getElementById('orderForm').submit();
                    }
                </script>
            </div>
        </div>
    </section>
</body>
</html>