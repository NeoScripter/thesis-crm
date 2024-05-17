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
    <header class="account-header">
        <ul class="menu-member">
            <li class="header-username"><?php echo 'Привет, ' . $_SESSION["useruid"]; ?></li>
            <li><a href="includes/logout.inc.php" class="header-logout">Разлогиниться</a></li>
        </ul>
    </header>
    <p class="login-success">Successful login!</p>
</body>