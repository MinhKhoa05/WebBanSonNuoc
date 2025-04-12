<?php
function config_connect()
{
    $host = 'localhost';
    $dbname = 'bansonnuoc';
    $username = 'root';
    $password = '';
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    return new PDO($dsn, $username, $password, $options);
}
?>
