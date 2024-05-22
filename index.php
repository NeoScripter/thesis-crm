<?php 
    session_start();
    $code_field = isset($_SESSION["under-verification"]) ? 'flex' : 'none';
    $email_field = ($code_field === 'flex') ? 'none' : 'flex';
    $login_errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : '';
    $signup_errors = isset($_SESSION["signup_errors"]) ? $_SESSION["signup_errors"] : '';
    $email_errors = isset($_SESSION["email_errors"]) ? $_SESSION["email_errors"] : '';   
    unset($_SESSION["under-verification"], $_SESSION["login_errors"], $_SESSION["signup_errors"], $_SESSION["email_errors"]);
    
    $switch_btn = ($_SESSION['display_signup']) ? 'Для заказчиков' : 'Для клиентов';
    $display_signup = ($_SESSION['display_signup']) ? 'flex' : 'none';
    $display_order = ($_SESSION['display_signup']) ? 'none' : 'flex';
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
    <div class="index-outer-wrapper">
        <section class="intro">
            <div class="gif-wrapper">
                <img src="assets/images/crm-gif.gif" alt="демонстрация работы систему CRM" class="gif-img">
                <div class="gif-desc">
                    <p>Простая и удобная система взаимодействия с клиентами и учета товара, оставшегося в наличии</p>
                </div>
            </div>
            <div class="intro-header">
                <h1 class="intro-h1">Система контакта с клиентами</h1>
                <form action="includes/redirect.php" method="post">
                    <button type="submit" class="switch-user" name="switch-user"><?php echo $switch_btn ;?></button>
                </form>
            </div>
        </section>
        <section class="form-wrapper" style="display: <?php echo $display_signup ;?>">
            <div class="index-signup">
                <h3>Зарегистрироваться</h3>
                <p>Введите ваши данные для регистрации</p>
                <form action="includes/signup.inc.php" method="post" class="signup-form">
                    <input type="text" name="uid" placeholder="Имя">
                    <input type="password" name="pwd" placeholder="Пароль">
                    <input type="password" name="pwdrepeat" placeholder="Повторите пароль">
                    <input type="email" name="email" placeholder="Email">
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
        <section class="order-wrapper" style="display: <?php echo $display_order ;?>">
            <form action="includes/send_email.php" class="index-order" method="post" style="<?php echo 'display: ' . $email_field; ?>">
                <h3>Оставить заявку</h3>
                <input type="email" name="email" placeholder="Email">
                <p class="errors-signup"><?php echo $email_errors ;?></p>
                <button type="submit" name="submit" class="submit-btn">Отправить</button>
            </form>
            <form action="includes/verify_email.php" class="code-verify" method="post" style="<?php echo 'display: ' . $code_field; ?>">
                <p>На указанный вами email<br> отправлен 6-значный код.<br> Введите его в поле снизу</p>
                <input type="number" name="code" placeholder="Код">
                <p class="errors-signup"><?php echo $email_errors ;?></p>
                <button type="submit" name="submit" class="submit-btn">Подтвердить</button>
            </form>
        </section>
    </div>
</body>
</html>