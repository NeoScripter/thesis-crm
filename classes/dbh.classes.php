<?php

class Dbh {
    protected function connect() {
        try {
            $username = "root";
            $password = "";
            $host = 'localhost';
            $dbname = 'ooplogin';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            // Initial connection DSN without specifying the database
            $dsnWithoutDb = 'mysql:host=' . $host . ';charset=utf8mb4';

            // Connect to MySQL server without a database
            $dbh = new PDO($dsnWithoutDb, $username, $password, $options);

            // Check if database exists, if not create it
            $dbh->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            // Update DSN to connect to the specified database
            $dsnWithDb = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4';

            // Reconnect to the new database
            $dbh = new PDO($dsnWithDb, $username, $password, $options);

            // Ensure the connection is UTF-8 encoded
            $dbh->exec("SET NAMES 'utf8mb4'");
            $dbh->exec("SET CHARACTER SET utf8mb4");

            // Create users table if it does not exist
            $createTableUsers = "CREATE TABLE IF NOT EXISTS users (
                users_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
                users_uid TINYTEXT not null,
                users_pwd LONGTEXT not null,
                users_email TINYTEXT not null,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $createTableProfilers = "CREATE TABLE IF NOT EXISTS profiles (
                profiles_id int NOT NULL AUTO_INCREMENT,
                profiles_firstname TEXT NOT NULL,
                profiles_lastname TEXT NOT NULL,
                profiles_patronymic TEXT NOT NULL,
                profiles_picture TEXT NOT NULL,
                profiles_material TEXT NOT NULL,
                users_id int,
                PRIMARY KEY (profiles_id),
                FOREIGN KEY (users_id) REFERENCES users(users_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $createTableOrders = "CREATE TABLE IF NOT EXISTS orders (
                order_id int NOT NULL AUTO_INCREMENT,
                username TEXT NOT NULL,
                phone TEXT NOT NULL,
                item_material TEXT NOT NULL,
                item_description TEXT NOT NULL,
                item_image TEXT NOT NULL,
                item_comment TEXT NOT NULL,
                finished VARCHAR(255) DEFAULT 'Нет',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                selected_worker int,
                PRIMARY KEY (order_id),
                FOREIGN KEY (selected_worker) REFERENCES profiles(profiles_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $createTableResources = "CREATE TABLE IF NOT EXISTS resources (
                src_id int NOT NULL AUTO_INCREMENT,
                users_id INT,
                src_name VARCHAR(255),
                src_qnt VARCHAR(255),
                PRIMARY KEY (src_id),
                FOREIGN KEY (users_id) REFERENCES profiles(profiles_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $dbh->exec($createTableUsers);
            $dbh->exec($createTableProfilers);
            $dbh->exec($createTableOrders);
            $dbh->exec($createTableResources);

            return $dbh;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

class DbhHandler extends Dbh {
    public function addResource($userId, $srcName, $srcQnt) {
        try {
            $stmt_check = $this->connect()->prepare("SELECT * FROM resources WHERE users_id = ? AND src_name = ?");
            $stmt_check->execute([$userId, $srcName]);
            
            if ($stmt_check->rowCount() > 0) {
                $sql_insert = "INSERT INTO resources (users_id, src_name, src_qnt) VALUES (?, ?, ?)";
                $stmt_insert = $this->connect()->prepare($sql_insert);
                $stmt_insert->execute([$userId, $srcName, $srcQnt]);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function updateResource($userId, $srcName, $srcQnt) {
        try {
            $stmt_check = $this->connect()->prepare("SELECT * FROM resources WHERE users_id = ? AND src_name = ?");
            $stmt_check->execute([$userId, $srcName]);
            
            if ($stmt_check->rowCount() > 0) {
                $sql_update = "UPDATE resources SET src_qnt = ? WHERE users_id = ? AND src_name = ?";
                $stmt_update = $this->connect()->prepare($sql_update);
                $stmt_update->execute([$srcQnt, $userId, $srcName]);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function fetchResourceById($id) {
        try {
            $sql = "SELECT * FROM resources WHERE users_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE users_uid = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function finishOrder($is_order_completed, $id) {
        $sql = "UPDATE orders SET finished = ? WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$is_order_completed, $id]);
    }

    public function getWorkersByMaterial($material) {
        $sql = "SELECT * FROM profiles WHERE profiles_material = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$material]);
        return $stmt->fetchAll();
    }
    
}
