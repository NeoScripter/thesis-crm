<?php 
    session_start();
    if (isset($_SESSION['order_submitted'])) {
        echo '<script>alert("Ваша заявка успешно отправлена!")</script>';
        session_unset();
        session_destroy();
    }
    $code_field = isset($_SESSION["under-verification"]) ? 'flex' : 'none';
    $email_field = ($code_field === 'flex') ? 'none' : 'flex';
    $login_errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : '';
    $signup_errors = isset($_SESSION["signup_errors"]) ? $_SESSION["signup_errors"] : '';
    $email_errors = isset($_SESSION["email_errors"]) ? $_SESSION["email_errors"] : '';
    $email_entered = isset($_SESSION["email-entered"]) ? $_SESSION["email-entered"] : '';   
    unset($_SESSION["under-verification"], $_SESSION["login_errors"], $_SESSION["signup_errors"], $_SESSION["email_errors"]);

    if (!isset($_SESSION['display_signup'])) {
        $_SESSION['display_signup'] = true;
    }
    
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
</head>
<body>
    <div class="index-outer-wrapper">
        <div class="index-frame">
            <div class="fake-nav"></div>
            <div class="intro-wrapper">
                <div class="intro">
                    <img src="assets/images/logo.png" alt="logo" class="logo">
                    <div>
                        <h1 class="intro-h1">Система контакта с клиентами</h1>
                        <p class="intro-p">Простая и удобная система взаимодействия с клиентами и учета товара, оставшегося в наличии</p>
                    </div>
                </div>
            </div>
            <form action="includes/redirect.php" method="post" class="switch-form">
                <button type="submit" class="switch-user" name="switch-user"><?php echo $switch_btn ;?></button>
            </form>
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
                    <p>На <?php echo $email_entered ;?><br> отправлен 6-значный код.<br> Введите его в поле снизу</p>
                    <input type="number" name="code" placeholder="Код">
                    <p class="errors-signup"><?php echo $email_errors ;?></p>
                    <button type="submit" name="submit" class="submit-btn">Подтвердить</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>