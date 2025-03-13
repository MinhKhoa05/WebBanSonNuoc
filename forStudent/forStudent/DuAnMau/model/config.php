<?php
    function connect()
    {
        $host = "localhost";
        $dbname = "thoitrang";
        $username = "root";
        $password = "";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
        $DBH = new PDO("mysql:host=$host;dbname=$dbname",$username, $password,$options);
        return $DBH;
    }
?>