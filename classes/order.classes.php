<?php

class OrderInfo extends Dbh {
    protected function verifyOrder($name, $materail, $description, $image, $id, $comment) {
        $stmt = $this->connect()->prepare('INSERT INTO orders (username, item_material, item_description, item_image, selected_worker, item_comment) VALUES (?, ?, ?, ?, ?, ?);');


        if (!$stmt->execute(array($name, $materail, $description, $image, $id, $comment))) {
            $stmt = null;
            header('location: ../index.php?error-stmtfailed');
            exit();
        }
        
        $stmt = null;
    }
    
    protected function getOrderById($id) {
        $stmt = $this->connect()->prepare('SELECT * FROM orders WHERE selected_worker = ?;');

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: profile.php?error=profilenotfound");
            exit();
        }

        $orderData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orderData;
    }
}