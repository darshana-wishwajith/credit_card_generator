<?php
    class Database{

        public static $connection;

        public static function setUpConnection(){

            if(!isset(Database::$connection)){

                $hostname = "127.0.0.1";
                $username = "root";
                $password = "password";
                $database = "credit_card_db";
                $port = "3306";

                Database::$connection = new mysqli($hostname,  $username, $password, $database, $port);
            }
        }

        public static function iud($query){
            Database::setUpConnection();

            Database::$connection->query($query);

        }
        public static function search($query){
            Database::setUpConnection();

            $result = Database::$connection->query($query);

            return $result;
        }
    }
?>