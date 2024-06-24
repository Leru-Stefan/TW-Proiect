<?php
class BD {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bd";

            self::$connection = new mysqli($servername, $username, $password, $dbname);

            if (self::$connection->connect_error) {
                die("Conexiunea a eșuat: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
?>