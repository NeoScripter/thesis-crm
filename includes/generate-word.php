<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include "../classes/dbh.classes.php";
    $dbHandler = new DbhHandler();

    $profile_id = $_POST['profile-id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $all_srcs = $dbHandler->fetchResourceById($profile_id);
    $all_orders = $dbHandler->fetchOrdersByDate($start_date, $end_date, $profile_id, 'Да');

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=document.doc");

    ob_start();
    echo '<html>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
    echo '<body>';
    echo '<h1>Отчет</h1>';
    echo '<p>Заказы</p>';
    $index = 1;
    foreach($all_orders as $order) {
        echo nl2br($index . ') Заказ № ' . $order['order_id'] . "\n");
        echo nl2br('Заказчик: ' . htmlspecialchars($order['username']) . "\n");
        echo nl2br('Телефон: ' . htmlspecialchars($order['phone']) . "\n");
        echo nl2br('Описание: ' . htmlspecialchars($order['item_description']) . "\n");
        echo nl2br('Комментарий к заказу: ' . htmlspecialchars($order['item_comment']) . "\n");
        echo nl2br('Создан: ' . htmlspecialchars($order['created_at']) . "\n\n");
        $index++;
    }

    if ($index === 1) {
        echo '<p>За указанный период заказов не найдено.</p>';
    }

    echo '<p>Текущие ресурсы</p>';

    $index_src = 1;
    foreach($all_srcs as $src) {
        echo nl2br($index_src . ') ' . htmlspecialchars($src['src_name']) . "\n");
        echo nl2br('Количество: ' . htmlspecialchars($src['src_qnt']) . "\n\n");
        $index_src++;
    }

    if ($index_src === 1) {
        echo '<p>На данный момент у вас нет ресурсов.</p>';
    }
    echo '</body>';
    echo '</html>';

    $output = ob_get_clean();
    echo $output;

    $output = ob_get_clean();

    echo $output;
    exit;
} else {
    header("location: ../index.php");
    exit;
}
