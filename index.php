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
    <div class="outer-wrapper">
        <section class="intro">
            <div class="gif-wrapper">
                <img src="assets/images/crm-gif.gif" alt="демонстрация работы систему CRM" class="gif-img">
                <div class="gif-desc">
                    <p>Простая и удобная система взаимодействия с клиентами и учета товара, оставшегося в наличии</p>
                </div>
            </div>
            <div class="intro-header">
                <h1 class="intro-h1">Система контакта с клиентами</h1>
                <div class="logo">Быстро и удобно!</div>
            </div>
        </section>
        <section class="form-wrapper">
            <div class="index-signup">
                <h3>Зарегистрироваться</h3>
                <p>Введите ваши данные для регистрации</p>
                <form action="includes/signup.inc.php" method="post" class="signup-form">
                    <input type="text" name="uid" placeholder="Имя">
                    <input type="password" name="pwd" placeholder="Пароль">
                    <input type="password" name="pwdrepeat" placeholder="Повторите пароль">
                    <input type="email" name="email" placeholder="Емаил">
                    <button type="submit" name="submit" class="submit-btn">Создать</button>
                </form>
            </div>
            <div class="index-login">
                <h3>Войти</h3>
                <p>Нет аккаунта? Создайте учетную запись!</p>
                <form action="includes/login.inc.php" method="post" class="login-form">
                    <input type="text" name="uid" placeholder="Имя">
                    <input type="password" name="pwd" placeholder="Пароль">
                    <button type="submit" name="submit" class="submit-btn">Войти</button>
                </form>
            </div>
        </section>
    </div>
</body>
</html>