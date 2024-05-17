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
        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header('location: ../index.php?error=emptyInput');
            exit();
        }
        if ($this->invalidUid() == false) {
            // echo "Invalid user name!";
            header('location: ../index.php?error=username');
            exit();
        }
        if ($this->invalidEmail() == false) {
            // echo "Invalid email!";
            header('location: ../index.php?error=email');
            exit();
        }
        if ($this->pwdMatch() == false) {
            // echo "Passwords don't match!";
            header('location: ../index.php?error=passwordmatch');
            exit();
        }
        if ($this->uidTakenCheck() == false) {
            // echo "User or email taken!";
            header('location: ../index.php?error=useroremailtaken');
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
        if (!preg_match("/^[a-zA-Z0-9\x{0400}-\x{04FF}]*$/u", $this->uid)) {
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
}