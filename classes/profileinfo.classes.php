<?php

class ProfileInfo extends Dbh {
    protected function getProfileInfo($userId) {
        $stmt = $this->connect()->prepare('SELECT * FROM profiles WHERE users_id = ?;');

        if (!$stmt->execute(array($userId))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: profile.php?error=profilenotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;
    }

    protected function setNewProfileInfo($profileFirstName, $profileLastName, $profilePatronymic, $profilePicture, $profileMaterial, $userId) {
        $stmt = $this->connect()->prepare('UPDATE profiles SET profiles_firstname = ?, profiles_lastname = ?, profiles_patronymic = ?, profiles_picture = ?, profiles_material = ? WHERE users_id = ?;');

        if (!$stmt->execute(array($profileFirstName, $profileLastName, $profilePatronymic, $profilePicture, $profileMaterial, $userId))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function setProfileInfo($profileFirstName, $profileLastName, $profilePatronymic, $profilePicture, $profileMaterial, $userId) {
        $stmt = $this->connect()->prepare('INSERT INTO profiles (profiles_firstname, profiles_lastname, profiles_patronymic, profiles_picture, profiles_material, users_id) VALUES (?, ?, ?, ?, ?, ?);');

        if (!$stmt->execute(array($profileFirstName, $profileLastName, $profilePatronymic, $profilePicture, $profileMaterial, $userId))) {
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}