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
}