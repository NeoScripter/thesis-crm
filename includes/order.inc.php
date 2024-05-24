<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (isset($_POST['submitBtn'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $material = $_POST['material'];
    
        if (strtolower($material) != 'металл' && strtolower($material) != 'дерево') {
            $material = 'металл';
        }

        $item = $_POST['item'];
        $worker = $_POST['worker'];
        $comment = $_POST['comment'];

        $path;
        if (isset($_FILES['drawing']) && $_FILES['drawing']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['drawing']['tmp_name'];
            $fileName = $_FILES['drawing']['name'];
        
            $uploadFileDir = '../uploads/drawings/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
        
            $dest_path = $uploadFileDir . $fileName;

            if (!file_exists($dest_path)) {
                move_uploaded_file($fileTmpPath, $dest_path);
            }
            $path = 'uploads/profile-pics/' . $fileName;
        } else {
            $path = 'assets/images/' . 'default-drawing.jpg';
        }

        // Instantiate SignupContr class
        include "../classes/dbh.classes.php";
        include "../classes/order.classes.php";
        include "../classes/order-contr.classes.php";
        $order = new OrderInfoContr($name, $phone, $material, $item, $path, $worker, $comment);

        // Running error handlers and user signup
        $order->submitOrder();

        $_SESSION['order_submitted'] = true;
        // Going to back to front page
        header("location: ../index.php");
        exit;
    } else {
        $_SESSION["code-verified"] = true;
        $_SESSION["material"] = $_POST['material'];
        header("location: ../client_order.php");
        exit;
    }
} else {
    header("location: ../index.php");
    exit;
}