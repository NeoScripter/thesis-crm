<?php

class OrderInfo extends Dbh {
    protected function verifyOrder($name, $phone, $materail, $description, $image, $id, $comment) {
        $stmt = $this->connect()->prepare('INSERT INTO orders (username, phone, item_material, item_description, item_image, selected_worker, item_comment) VALUES (?, ?, ?, ?, ?, ?, ?);');


        if (!$stmt->execute(array($name, $phone, $materail, $description, $image, $id, $comment))) {
            $stmt = null;
            header('location: ../index.php?error-stmtfailed');
            exit();
        }
        
        $stmt = null;
    }

    public function getOrderInfo($profileId) {
        $stmt = $this->connect()->prepare('SELECT * FROM orders WHERE selected_worker = ?;');

        if (!$stmt->execute(array($profileId))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;
    }
}