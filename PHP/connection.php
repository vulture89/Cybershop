<?php

class Database{
    public static $connection;
    public static $user = "root";
    public static $pswd = "---";
    public static $db = "cybershop";
    public static $port = "3306";
    public static function setUpConnection() {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", Database::$user, Database::$pswd, Database::$db, Database::$port);
        }
    }
    public static function iud($q) {
        Database::setUpConnection();
        Database::$connection->query($q);
    }
    public static function search($q) {
        Database::setUpConnection();
        $resultSheet = Database::$connection->query($q);
        return $resultSheet;
    }

    public static function escapeString($string) {
        self::setUpConnection();
        return self::$connection->real_escape_string($string);
    }
}
?>