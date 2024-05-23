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
        $profilePicture = "assets/images/default-avatar.png";
        $profileMaterial = "металл";
        $this->setProfileInfo($profileFirstName, $profileLastName, $profilePatronymic, $profilePicture, $profileMaterial, $this->userId);
    }

    public function updateProfileInfo($firstName, $lastName, $patronymic, $picture, $material) {
        // Error handlers
        if ($this->emptyInputCheck($firstName, $lastName, $patronymic, $material) == true) {
            header("location: ../profilesettings.php?error=emptyInput");
            exit();
        }

        // Update profile info
        $this->setNewProfileInfo($firstName, $lastName, $patronymic, $picture, $material, $this->userId);
    }

    private function emptyInputCheck($firstName, $lastName, $patronymic, $material) {
        $result;
        if (empty($firstName) || empty($lastName) || empty($patronymic) || empty($material)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}