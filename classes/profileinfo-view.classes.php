<?php

class ProfileInfoView extends ProfileInfo {
    public function fetchFirstName($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_firstname"];
    }

    public function fetchLastName($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_lastname"];
    }

    public function fetchPatronymic($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_patronymic"];
    }

    public function fetchPicture($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_picture"];
    }

    public function fetchMaterial($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        return $profileInfo[0]["profiles_material"];
    }
}