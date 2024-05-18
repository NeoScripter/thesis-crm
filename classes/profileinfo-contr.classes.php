<?php

class ProfileInfoContr extends ProfileInfo {
    private $userId;
    private $userUid;

    public function __construct($userId, $userUid) {
        $this->userId = $userId;
        $this->userUid = $userUid;
    }

    public function defaultProfileInfo() {
        $profileFirstName = "Имя";
        $profileLastName = "Фамилия";
        $profilePatronymic = "Отчество";
        $profilePicture = "uploads/profile-pics/default-avatar.jpeg";
        $this->setProfileInfo($profileFirstName, $profileLastName, $profilePatronymic, $profilePicture, $this->userId);
    }

    public function updateProfileInfo($firstName, $lastName, $patronymic, $profilePicture) {
        // Error handlers
        if ($this->emptyInputCheck($firstName, $lastName, $patronymic) == true) {
            header("location: ../profilesettings.php?error=emptyInput");
            exit();
        }

        // Update profile info
        $this->setNewProfileInfo($firstName, $lastName, $patronymic, $profilePicture, $this->userId);
    }

    private function emptyInputCheck($firstName, $lastName, $patronymic) {
        $result;
        if (empty($firstName) || empty($lastName) || empty($patronymic)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}