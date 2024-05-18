<?php 
    session_start();
    $code_field = isset($_SESSION["code-verified"]) ? 'flex' : 'none';
    $login_errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : '';
    $signup_errors = isset($_SESSION["signup_errors"]) ? $_SESSION["signup_errors"] : '';    
    unset($_SESSION["code-verified"], $_SESSION["login_errors"], $_SESSION["signup_errors"]);
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
                <div class="switch-user">Для заказчиков</div>
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
                    <p class="errors-signup"><?php echo $signup_errors ;?></p>
                    <button type="submit" name="submit" class="submit-btn">Создать</button>
                </form>
            </div>
            <div class="index-login">
                <h3>Войти</h3>
                <p>Нет аккаунта? Создайте учетную запись!</p>
                <form action="includes/login.inc.php" method="post" class="login-form">
                    <input type="text" name="uid" placeholder="Имя">
                    <input type="password" name="pwd" placeholder="Пароль">
                    <p class="errors-login"><?php echo $login_errors ;?></p>
                    <button type="submit" name="submit" class="submit-btn">Войти</button>
                </form>
            </div>
        </section>
        <section class="order-wrapper">
            <form action="" class="index-order" method="post">
                <h3>Оставить заявку</h3>
                <input type="email" name="email" placeholder="Емаил">
                <button type="submit" name="submit" class="submit-btn">Отправить</button>
            </form>
            <form action="" class="code-verify" method="post" style="<?php echo 'display: ' . $code_field; ?>">
                <p>На указанный вами емаил отправлен 6-значный код. Введите его в поле снизу</p>
                <input type="number" name="code" placeholder="Код">
                <button type="submit" name="submit" class="submit-btn">Подтвердить</button>
            </form>
        </section>
    </div>
</body>
</html>