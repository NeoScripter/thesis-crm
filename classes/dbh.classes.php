<?php

class Dbh {
    protected function connect() {
        try {
            $username = "root";
            $password = "";
            $dsn = 'mysql:host=localhost;dbname=ooplogin;charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $dbh = new PDO($dsn, $username, $password, $options);

            // Explicitly setting the character set (redundant, but ensures connection is UTF-8)
            $dbh->exec("SET NAMES 'utf8mb4'");
            $dbh->exec("SET CHARACTER SET utf8mb4");

            return $dbh;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
