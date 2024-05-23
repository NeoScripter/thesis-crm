<?php

class SignupContr extends Signup {
     
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email) {
        if (!mb_check_encoding($uid, 'UTF-8')) {
            $uid = mb_convert_encoding($uid, 'UTF-8');
        }
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function signupUser() {
        session_start();
        if ($this->emptyInput() == false) {
            $_SESSION["signup_errors"] = "Заполните все поля";
            header('location: ../index.php');
            exit();
        }
        if ($this->invalidUid() == false) {
            $_SESSION["signup_errors"] = "Используйте только буквы или цифры для имени пользователя";
            header('location: ../index.php');
            exit();
        }
        if ($this->invalidEmail() == false) {
            $_SESSION["signup_errors"] = "Укажите правильный емаил";
            header('location: ../index.php');
            exit();
        }
        if ($this->pwdMatch() == false) {
            $_SESSION["signup_errors"] = "Пароли должны совпадать";
            header('location: ../index.php');
            exit();
        }
        if ($this->uidTakenCheck() == false) {
            $_SESSION["signup_errors"] = "Данный пользователь уже зарегистрирован";
            header('location: ../index.php');
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    private function emptyInput() {
        $result;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9\x{0400}-\x{04FF} ]*$/u", $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail() {
        $result;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch() {
        $result;
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck() {
        $result;
        if (!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function fetchUserId($uid) {
        $userId = $this->getUserId($uid);
        return $userId[0]["users_id"];
    }
}