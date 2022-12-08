<?php

class User {

    public function Login() {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $sql = "SELECT * FROM `User2` WHERE username=:username AND password=:password";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(
            ":username" => $this->username,
            ":password" => $this->password
        ));

        $list = Array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->username = $row["username"];
            $user->password = $row["password"];
            array_push($list, $user);
        }

        $conn = NULL;
        return $list;
    }

    public function CheckUserExistsOrNot() {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $sql = "SELECT * FROM `User2` WHERE username=:username";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(
            ":username" => $this->username
        ));

        $list = Array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->username = $row["username"];
            array_push($list, $user);
        }

        $conn = NULL;
        return $list;
    }

    public function AddNewUsers() {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $sql = "INSERT INTO `User2`(
                        `username`,
                        `password`        
                    )
                    VALUES(          
                        :username,
                        :password                  
                    );";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(
            ":username" => $this->username,
            ":password" => $this->password
        ));

        $conn = NULL;
    }

    public function ChangePassword() {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $sql = "UPDATE `User2` 
                    SET `password`=:password
                    WHERE `username`=:username";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(
            ":username" => $this->username,
            ":password" => $this->password
        ));

        $conn = NULL;
    }

    public function ShowAllUsers() {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $sql = "SELECT * FROM `User2`";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $list = Array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();

            $user->username = $row["username"];
            $user->password = $row["password"];

            array_push($list, $user);
        }

        $conn = NULL;
        return $list;
    }

    public function DeleteUser() {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $sql = "DELETE FROM `User2`
                    WHERE `username`=:username";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(
            ":username" => $this->username
        ));

        $conn = NULL;
    }

}

?>