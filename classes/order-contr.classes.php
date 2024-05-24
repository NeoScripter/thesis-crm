<?php

class OrderInfoContr extends OrderInfo {
    private $name;
    private $phone;
    private $item_material;
    private $item_description;
    private $item_image;
    private $worker_id;
    private $item_comment;

    public function __construct($name, $phone, $item_material, $item_description, $item_image, $worker_id, $item_comment) {
        $this->name = $name;
        $this->phone = $phone;
        $this->item_material = $item_material;
        $this->item_description = $item_description;
        $this->item_image = $item_image;
        $this->worker_id = $worker_id;
        $this->item_comment = $item_comment;
    }

    public function submitOrder() {
        if ($this->emptyInput() == false) {
            $_SESSION["order_creation_errors"] = "Заполните все поля";
            header('location: ../client_order.php');
            exit();
        }
        if ($this->invalidName() == false) {
            $_SESSION["order_creation_errors"] = "Используйте только буквы, цифры или пробелы";
            header('location: ../client_order.php');
            exit();
        }
        if ($this->invalidPhone() == false) {
            $_SESSION["order_creation_errors"] = "Неправильный номер телефона";
            header('location: ../client_order.php');
            exit();
        }

        $this->verifyOrder($this->name, $this->phone, $this->item_material, $this->item_description, $this->item_image, $this->worker_id, $this->item_comment);
    }

    private function emptyInput() {
        $result;
        if (empty($this->name) || empty($this->item_description) || empty($this->item_comment)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidName() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9\x{0400}-\x{04FF} ]*$/u", $this->name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidPhone() {
        $result;
        if (!preg_match("/^[0-9 -]*$/u", $this->phone)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}