<?php

session_start();
if (!isset($_SESSION["code-verified"])) {
    header("location: index.php");
} 

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
                <form action="#" method="post" enctype="multipart/form-data">
                    <label for="name">Введите ваше полное имя</label>
                    <input type="text" name="name" value="">
                    <label for="material">Выберите тип изделия</label>
                    <select name="material">
                        <option value="металл">Металл</option>
                        <option value="дерево">Дерево</option>
                    </select>
                    <label for="item">Укажите название изделия</label>
                    <input type="text" name="item" value="">
                    <label for="drawing">Чертеж изделия</label>
                    <input type="file" name="drawing" placeholder="Чертеж">
                    <label for="worker">Выберите исполнителя</label>
                    <select name="worker">
                        <option value="металл">Вася</option>
                        <option value="дерево">Коля</option>
                    </select>
                    <label for="comment">Оставьте комментарий к заказу</label>
                    <textarea id="comment" name="comment" rows="2"></textarea>
                    <button type="submit" name="submit">Отправить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>