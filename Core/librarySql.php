<?php

require_once 'config.php';

class LibrarySql {

    public static function implementSqlCommand($sql) {
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
        $conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $conn = NULL;
    }

}

?>    